<div class="space-y-4">

    {{-- Search --}}
    <div class="relative">

        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Search classes..."
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
                        Teacher
                    </th>

                    <th class="px-6 py-3 text-left">
                        Students
                    </th>

                    <th class="px-6 py-3 text-left">
                        Capacity
                    </th>

                    <th class="px-6 py-3 text-left">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($classes as $class)

                    <tr
                        wire:key="class-{{ $class->id }}"
                        class="border-t dark:border-zinc-700"
                    >

                        {{-- Name --}}
                        <td class="px-6 py-4 font-medium">

                            <a
                                href="{{ route('admin.classes.show', $class) }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-400"
                            >
                                {{ $class->name }}
                            </a>

                        </td>


                        {{-- Teacher --}}
                        <td class="px-6 py-4">

                            <a
                                href="{{ route('admin.teachers.show', $class->teacher) }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-400"
                            >
                                {{ $class->teacher->name }}
                            </a>

                        </td>


                        {{-- Students --}}
                        <td class="px-6 py-4">
                            {{ $class->students_count }}
                        </td>


                        {{-- Capacity --}}
                        <td class="px-6 py-4">
                            {{ $class->capacity }}
                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4">

                            <span
                                class="rounded-full px-3 py-1 text-sm
                                    {{ $class->students_count < $class->capacity
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}"
                            >
                                {{ $class->students_count < $class->capacity
                                    ? 'Available'
                                    : 'Full' }}
                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-10 text-center text-zinc-500"
                        >
                            No classes found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>


        {{-- Pagination --}}
        <div class="border-t px-6 py-4 dark:border-zinc-700">
            {{ $classes->links() }}
        </div>

    </div>

</div>
