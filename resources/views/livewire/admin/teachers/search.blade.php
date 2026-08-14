<div class="space-y-4">

    {{-- Search --}}
    <div class="relative">

        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Search teachers..."
            class="w-full rounded-lg border border-zinc-300 px-4 py-2
                   dark:border-zinc-700 dark:bg-zinc-800"
        >

        <div
            wire:loading
            wire:target="search"
            class="absolute right-3 top-1/2 -translate-y-1/2"
        >
            Searching...
        </div>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

        <table class="min-w-full">

            <thead class="bg-zinc-100 dark:bg-zinc-800">

                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Students</th>
                </tr>

            </thead>

<tbody>
    @forelse($teachers as $teacher)
        <tr
            wire:key="teacher-{{ $teacher->id }}"
            class="border-t dark:border-zinc-700"
        >
            <td class="px-6 py-4">
                <a
                    href="{{ route('admin.teachers.show', $teacher) }}"
                    class="text-blue-600 hover:underline"
                >
                    {{ $teacher->name }}
                </a>
            </td>

            <td class="px-6 py-4">
                {{ $teacher->email }}
            </td>

            <td class="px-6 py-4">
                {{ $teacher->students_count }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="px-6 py-8 text-center text-zinc-500">
                No teachers found.
            </td>
        </tr>
    @endforelse
</tbody>
        </table>

        <div class="border-t px-6 py-4">
            {{ $teachers->links() }}
        </div>

    </div>

</div>
