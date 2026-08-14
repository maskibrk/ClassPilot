<div class="space-y-4">

    {{-- Search --}}
    <div class="relative">

        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Search parents..."
            class="w-full rounded-lg border border-zinc-300 px-4 py-2
                   dark:border-zinc-700 dark:bg-zinc-800"
        >

        <div
            wire:loading
            wire:target="search"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-zinc-500"
        >
            Searching...
        </div>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

        <table class="min-w-full">

            <thead class="bg-zinc-100 dark:bg-zinc-800">

                <tr>

                    <th class="px-6 py-3 text-left">
                        Name
                    </th>

                    <th class="px-6 py-3 text-left">
                        Email
                    </th>

                    <th class="px-6 py-3 text-left">
                        Children
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($parents as $parent)

                    <tr
                        wire:key="parent-{{ $parent->id }}"
                        class="border-t dark:border-zinc-700"
                    >

                        <td class="px-6 py-4">

                            <a
                                href="{{ route('admin.parents.show', $parent) }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-400"
                            >
                                {{ $parent->name }}
                            </a>

                        </td>


                        <td class="px-6 py-4">
                            {{ $parent->email }}
                        </td>


                        <td class="px-6 py-4">
                            {{ $parent->children_count }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="3"
                            class="px-6 py-10 text-center text-zinc-500"
                        >
                            No parents found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>


        {{-- Pagination --}}
        <div class="border-t px-6 py-4 dark:border-zinc-700">
            {{ $parents->links() }}
        </div>

    </div>

</div>
