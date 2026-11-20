@extends('layouts.app')
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="pt-4">
            @if(session('success'))
                <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        @if(auth()->user()->hasRole('super_admin'))
            @include('companies.partials.listing')
        @elseif(auth()->user()->hasRole('admin'))
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Team Member</h2>
                </div>
                <div>
                    <a href="{{ route('invitations.create') }}" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Invite User</a>
                </div>
            </div>
            @include('companies.partials.users-listing')
        @endif
        @include('short_urls.partials.listing')
    </div>
</div>
@endsection