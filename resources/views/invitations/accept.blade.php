
@extends('layouts.invitation')
@section('content')
    <div class="max-w-lg mx-auto py-10 px-4">
        <div class="bg-white p-6">
            <div class="mb-6">
                <h2 class="text-2xl">Accept Invitation</h2>
                <p class="mt-2">You have been invited to join <strong>{{ $invitation->company->name }}</strong>.</p>
                <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $invitation->email }}</p>
            </div>

            <form method="POST" action="{{ route('invitations.accept.store', request()->route('token')) }}">
                @csrf
                <div class="mb-5">
                    <label for="password" class="mb-2">Create Password</label>
                    <input type="password" name="password" id="password" required minlength="8" autocomplete="new-password" class="w-full rounded-lg" placeholder="Enter password">
                    @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="w-full rounded-lg" placeholder="Confirm password">
                </div>
                <button type="submit" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Accept Invitation & Create Account</button>
            </form>
        </div>
    </div>
@endsection
