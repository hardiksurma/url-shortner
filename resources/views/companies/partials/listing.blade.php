<div class="bg-white">
    <div class="p-6">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Companies</h3>
            </div>
            <div>
                <a href="{{ route('companies.create') }}" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Add Company</a>
            </div>
        </div>
    </div>

    <div>
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                <tr>
                    <th class="px-6 py-3 font-medium">#</th>
                    <th class="px-6 py-3 font-medium">Company</th>
                    <th class="px-6 py-3 font-medium">Email</th>
                    <th class="px-6 py-3 font-medium">Created At</th>
                    <th class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td class="px-6 py-3 font-medium">{{ $companies->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3 font-medium">
                            <div class="font-semibold text-gray-900">{{ $company->name }}</div>
                        </td>
                        <td class="px-6 py-3 font-medium">
                            <div class="font-semibold text-gray-900">{{ $company->email }}</div>
                        </td>
                        <td class="px-6 py-3 font-medium">
                            {{ $company->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-3 font-medium">
                            <div class="flex gap-1">
                                <a href="{{ route('companies.edit', $company) }}" class="px-5 py-2 bg-indigo-600 rounded-lg text-white">Edit</a>
                                <a href="{{ route('companies.users', $company->id) }}" class="px-5 py-2 bg-orange-800 rounded-lg text-white">View Users</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 font-medium">
                            <div class="text-gray-400 mb-2">No companies found.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($companies->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">{{ $companies->links() }}</div>
    @endif

</div>