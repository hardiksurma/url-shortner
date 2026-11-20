<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function create(Company $company)
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            abort_if(!$company, 404);
            $roles = Role::where('name', 'admin')->where('guard_name', 'web')->get();
        } elseif ($user->hasRole('admin')) {
            $company = $user->company;
            abort_if(!$company, 403);
            $roles = Role::whereIn('name', ['admin', 'member'])->where('guard_name', 'web')->get();
        } else {
            abort(403);
        }
        return view('invitations.create', compact('company', 'roles'));
    }

    public function store(Request $request, ?Company $company = null)
    {
        $user = Auth::user();
        if ($user->hasRole('super_admin')) {
            abort_if(!$company, 404);
            $allowedRoles = ['admin'];
        } elseif ($user->hasRole('admin')) {
            $company = $user->company;
            abort_if(!$company, 403);
            $allowedRoles = ['admin', 'member'];
        } else {
            abort(403);
        }

        $roleIds = Role::whereIn('name', $allowedRoles)->where('guard_name', 'web')->pluck('id')->toArray();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'role_id' => ['required', 'integer', 'in:' . implode(',', $roleIds)],
        ]);

        if (User::where('company_id', $company->id)->where('email', $validated['email'])->exists()) {
            return back()->withErrors(['email' => 'This user already belongs to this company.',])->withInput();
        }

        if (Invitation::where('company_id', $company->id)->where('email', $validated['email'])->whereNull('accepted_at')->where('expires_at', '>', now())->exists()) {
            return back()->withErrors(['email' => 'An active invitation already exists for this email.',])->withInput();
        }

        $plainToken = Str::random(64);
        $role = Role::findOrFail($validated['role_id']);
        $invitation = Invitation::create([
            'company_id' => $company->id,
            'invited_by' => $user->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'token' => hash('sha256', $plainToken),
            'expires_at' => now()->addDays(7),
        ]);

        try {
            Mail::to($invitation->email)->send(
                new InvitationMail($invitation, $plainToken, $company->name, $role->name)
            );
        } catch (\Throwable $e) {
            $invitation->delete();
            
            return back()->withInput()->withErrors([
                'email' => 'Invitation email could not be sent. Please check your SMTP configuration.',
            ]);
        }
        return redirect()->route('dashboard', $company->id)->with('success', 'Invitation email sent successfully.');
    }

    public function showAcceptForm(string $token)
    {
        $invitation = Invitation::where('token', hash('sha256', $token))->whereNull('accepted_at')->firstOrFail();
        return view('invitations.accept', compact('invitation'));
    }

    public function accept(Request $request, string $token)
    {
        $invitation = Invitation::where('token', hash('sha256', $token))->whereNull('accepted_at')->firstOrFail();
        
        if (User::where('email', $invitation->email)->exists()) {
            return back()->withErrors(['email' => 'An account with this email already exists.',]);
        }

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $role = Role::where('id', $invitation->role_id)->where('guard_name', 'web')->firstOrFail();

        abort_unless(in_array($role->name, ['admin', 'member']), 403);

        $newUser = DB::transaction(function () use ($invitation, $role, $validated) {
            $user = new User();
            $user->name = $invitation->name;
            $user->email = $invitation->email;
            $user->company_id = $invitation->company_id;
            $user->password = Hash::make($validated['password']);
            $user->save();

            $user->assignRole($role);

            $invitation->accepted_at = now();
            $invitation->save();

            return $user;
        });

        Auth::login($newUser);

        return redirect()->route('dashboard')->with('success', 'Your account has been created successfully.');
    }
}
