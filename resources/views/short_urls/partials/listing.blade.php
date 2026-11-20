<div class="bg-white overflow-hidden shadow-sm mt-5">
    <div class="p-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Short URLs</h3>
            </div>
            <div>
                @if(auth()->user()->hasAnyRole(['admin', 'member']))
                    <a href="{{ route('short-urls.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Create Short URL</a>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-5">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <tr>
                        <th class="px-6 py-3 font-medium text-left">Original URL</th>
                        <th class="px-6 py-3 font-medium text-left">Short URL</th>
                        <th class="px-6 py-3 font-medium text-left">Created By</th>
                        @if(auth()->user()->hasAnyRole(['super_admin']))
                            <th class="px-6 py-3 font-medium text-left">Company Name</th>
                        @endif
                        <th class="px-6 py-3 font-medium">Clicks</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($shortUrls as $shortUrl)
                        <tr>
                            <td class="px-6 py-3 font-medium break-all">{{ $shortUrl->original_url }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('short-urls.redirect', $shortUrl->short_code) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                    {{ url('/' . $shortUrl->short_code) }}
                                </a>
                            </td>
                            <td class="px-6 py-3 font-medium">{{ $shortUrl->user->name ?? 'N/A' }}</td>
                            @if(auth()->user()->hasAnyRole(['super_admin']))
                                <td class="px-6 py-3 font-medium">{{ $shortUrl->company->name ?? 'N/A' }}</td>
                            @endif
                            <td class="px-6 py-3 font-medium">{{ $shortUrl->clicks }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500">No short URLs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4">{{ $shortUrls->links() }}</div>
        </div>
    </div>
</div>