@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <div class="p-6">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $company->name }} - Users</h3>
                </div>
                <div>
                    <a href="{{ route('invitations.create', $company->id) }}" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Invite User</a>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 rounded-lg">Back</a>
                </div>
            </div>
        </div>
        @include('companies.partials.users-listing')
    </div>
@endsection