
@extends('layouts.app')
@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <h2 class="text-2xl">Edit Company</h2>
        </div>
        <div class="bg-white shadow-sm sm:rounded-xl p-6">
            <form action="{{ route('companies.update', $company) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="mb-2">Company Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" placeholder="Enter company name" required class="w-full rounded-lg">
                    @error('name')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-6">
                    <label for="email" class="mb-2">Company Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}" placeholder="Enter company email" required class="w-full rounded-lg">
                    @error('email')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-end gap-3 pt-5">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</a>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Create Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
