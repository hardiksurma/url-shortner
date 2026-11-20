
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl">Create Short URL</h2>
    <div class="bg-white shadow-sm rounded-lg p-6">
        <form method="POST" action="{{ route('short-urls.store') }}">
            @csrf
            <div class="mb-6">
                <label for="original_url">Original URL</label>
                <input type="url" name="original_url" id="original_url" value="{{ old('original_url') }}" placeholder="https://example.com" required class="w-full rounded-md">
                @error('original_url')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Create Short URL</button>
            </div>
        </form>
    </div>
</div>
@endsection
