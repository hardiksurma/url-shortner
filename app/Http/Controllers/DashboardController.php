<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $companies = Company::latest()->paginate(10, ['*'], 'companies_page');
            $shortUrls = ShortUrl::with(['user', 'company'])->latest()->paginate(10, ['*'], 'short_urls_page');
            return view('dashboard', compact('companies', 'shortUrls'));
        }

        if ($user->hasRole('admin')) {
            $users = User::where('company_id', $user->company_id)->with('roles')->latest()->paginate(10, ['*'], 'users_page');
            $shortUrls = ShortUrl::with('user')->where('company_id', $user->company_id)->latest()->paginate(10, ['*'], 'short_urls_page');
            return view('dashboard', compact('users', 'shortUrls'));
        }

        if ($user->hasRole('member')) {
            $shortUrls = ShortUrl::where('user_id', $user->id)->latest()->paginate(10, ['*'], 'short_urls_page');
            return view('dashboard', compact('shortUrls'));
        }

        abort(403);
    }
}
