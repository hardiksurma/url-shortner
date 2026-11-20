<div class="bg-white">
    <table class="min-w-full">
        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
            <tr>
                <th class="px-6 py-3 font-medium">Name</th>
                <th class="px-6 py-3 font-medium">Email</th>
                <th class="px-6 py-3 font-medium">Role</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @forelse($users as $user)
                <tr>
                    <td class="px-6 py-3 font-medium">{{ $user->name }}</td>
                    <td class="px-6 py-3 font-medium">{{ $user->email }}</td>
                    <td class="px-6 py-3 font-medium">{{ $user->getRoleNames()->implode(', ') ?: 'No role assigned' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" scope="col" class="px-6 py-3 font-medium">
                        <div class="text-gray-400 mb-2">No users found.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $users->links() }}</div>
</div>