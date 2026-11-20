
@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold">Invite User</h2>
        </div>
        <div class="bg-white rounded-lg p-6">
            <form method="POST" action="{{ auth()->user()->hasRole('super_admin') ? route('invitations.store', $company->id) : route('invitations.store') }}">
                @csrf
                <div class="mb-5">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-md" placeholder="Enter user's name">
                    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-5">
                    <label for="email">Email</label>

                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full rounded-md" placeholder="Enter email address">
                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-5">
                    <label>Company</label>
                    <input type="text" value="{{ $company->name }}" disabled class="w-full rounded-md bg-gray-100 text-gray-600">
                </div>
                <div class="mb-6">
                    <label for="role_id">Role</label>
                    <select name="role_id" id="role_id" required class="w-full rounded-md">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $role->name)) }}</option>
                        @endforeach
                    </select>
                    @error('role_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</a>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Send Invitation</button>
                </div>
            </form>
        </div>
    </div>
@endsection
