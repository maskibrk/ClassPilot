<div class="space-y-6">
{{-- Quick Stats --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

    {{-- Total Parents --}}
    <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
            <flux:icon name="users" class="size-5" />
        </div>

        <div>

            <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                Total Parents
            </flux:text>

            <flux:heading size="lg">
                {{ $totalParents ?? '—' }}
            </flux:heading>

        </div>

    </flux:card>



    {{-- Total Children --}}
    <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
            <flux:icon name="academic-cap" class="size-5" />
        </div>

        <div>

            <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                Children assigned to a parent
            </flux:text>

            <flux:heading size="lg">
                {{ $totalChildren ?? '—' }}
            </flux:heading>

        </div>

    </flux:card>

</div>


{{-- Search --}}
<div class="flex flex-col gap-3 sm:flex-row sm:items-center">

    <flux:field class="flex-1">

        <div class="relative">

            <flux:input
                type="search"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by parent name or email..."
                icon="magnifying-glass"
            />

            <div
                wire:loading
                wire:target="search"
                class="absolute right-3 top-1/2 -translate-y-1/2"
            >
                <flux:icon
                    name="arrow-path"
                    class="size-4 animate-spin text-zinc-400"
                />
            </div>

        </div>

    </flux:field>

</div>


{{-- Table --}}
<flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            {{-- Table Header --}}
            <thead
                class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900"
            >

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Parent
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Email
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Phone
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Children
                    </th>

                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        <span class="sr-only">Actions</span>
                    </th>

                </tr>

            </thead>


            {{-- Table Body --}}
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">

                @forelse($parents as $parent)

                    <tr
                        wire:key="parent-{{ $parent->id }}"
                        class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-900"
                    >

                        {{-- Parent --}}
                        <td class="px-6 py-4">

                            <a
                                href="{{ route('admin.parents.show', $parent) }}"
                                class="flex items-center gap-3"
                            >

                                <span
                                    class="flex size-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400"
                                >
                                    {{ collect(explode(' ', $parent->name))
                                        ->map(fn ($p) => $p[0] ?? '')
                                        ->take(2)
                                        ->implode('') }}
                                </span>

                                <span
                                    class="font-medium text-zinc-900 hover:text-blue-600 hover:underline dark:text-zinc-100 dark:hover:text-blue-400"
                                >
                                    {{ $parent->name }}
                                </span>

                            </a>

                        </td>


                        {{-- Email --}}
                        <td class="px-6 py-4">

                            <flux:text class="text-zinc-600 dark:text-zinc-400">
                                {{ $parent->email }}
                            </flux:text>

                        </td>


                        {{-- Phone --}}
                        <td class="px-6 py-4">

                            @if($parent->phone)

                                <flux:text class="text-zinc-600 dark:text-zinc-400">
                                    {{ $parent->phone }}
                                </flux:text>

                            @else

                                <flux:text class="text-zinc-400">
                                    —
                                </flux:text>

                            @endif

                        </td>


                        {{-- Children --}}
                        <td class="px-6 py-4">

                            <flux:badge
                                color="{{ $parent->children_count > 0 ? 'emerald' : 'zinc' }}"
                                size="sm"
                                icon="users"
                            >
                                {{ $parent->children_count }}
                            </flux:badge>

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">

                            <flux:button
                                href="{{ route('admin.parents.show', $parent) }}"
                                variant="ghost"
                                size="sm"
                                icon="chevron-right"
                                inset
                            />

                        </td>

                    </tr>


                @empty

                    {{-- Empty State --}}
                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-16"
                        >

                            <div class="flex flex-col items-center justify-center text-center">

                                <div
                                    class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900"
                                >

                                    <flux:icon
                                        name="magnifying-glass"
                                        class="size-6 text-zinc-400"
                                    />

                                </div>

                                <flux:heading size="sm">
                                    No parents found
                                </flux:heading>

                                <flux:text class="mt-1 text-zinc-500">
                                    Try adjusting your search.
                                </flux:text>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($parents->hasPages())

        <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
            {{ $parents->links() }}
        </div>

    @endif

</flux:card>

</div>
