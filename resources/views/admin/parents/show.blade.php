<x-layouts::app :title="$parent->name">
<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        <div class="space-y-2">

            <div class="flex items-center gap-2">

                <flux:button
                    href="{{ route('admin.parents.index') }}"
                    variant="ghost"
                    size="sm"
                    icon="arrow-left"
                    inset
                >
                    Parents
                </flux:button>

            </div>

            <flux:heading size="xl">
                {{ $parent->name }}
            </flux:heading>

            <flux:text class="text-zinc-500">
                Parent profile and children overview.
            </flux:text>

        </div>

        <flux:button
            href="{{ route('admin.parents.edit', $parent) }}"
            variant="primary"
            icon="pencil"
        >
            Edit Parent
        </flux:button>

    </div>


    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Children --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                <flux:icon name="users" class="size-5" />
            </div>

            <div>

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Children
                </flux:text>

                <flux:heading size="lg">
                    {{ $parent->children->count() }}
                </flux:heading>

            </div>

        </flux:card>


        {{-- Email --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                <flux:icon name="envelope" class="size-5" />
            </div>

            <div class="min-w-0">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Email
                </flux:text>

                <flux:text class="truncate font-medium">
                    {{ $parent->email }}
                </flux:text>

            </div>

        </flux:card>


        {{-- Phone --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                <flux:icon name="phone" class="size-5" />
            </div>

            <div class="min-w-0">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Phone
                </flux:text>

                <flux:text class="truncate font-medium">
                    {{ $parent->phone ?? 'Not provided' }}
                </flux:text>

            </div>

        </flux:card>

    </div>


    {{-- Parent Information --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Information --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <flux:heading size="lg">
                Parent Information
            </flux:heading>

            <div class="mt-5 divide-y divide-zinc-200 dark:divide-zinc-800">

                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Name
                    </flux:text>

                    <flux:text class="text-right font-medium">
                        {{ $parent->name }}
                    </flux:text>

                </div>

                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Email
                    </flux:text>

                    <flux:text class="text-right font-medium">
                        {{ $parent->email }}
                    </flux:text>

                </div>

                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Phone
                    </flux:text>

                    <flux:text class="text-right font-medium">
                        {{ $parent->phone ?? 'Not provided' }}
                    </flux:text>

                </div>

                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Children
                    </flux:text>

                    <flux:badge color="zinc">
                        {{ $parent->children->count() }}
                    </flux:badge>

                </div>

            </div>

        </flux:card>


        {{-- Profile --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <flux:heading size="lg">
                Parent
            </flux:heading>

            <div class="mt-5 flex items-center gap-4">

                <div class="flex size-14 shrink-0 items-center justify-center rounded-full bg-blue-50 text-lg font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">

                    {{ collect(explode(' ', $parent->name))
                        ->map(fn ($part) => $part[0] ?? '')
                        ->take(2)
                        ->implode('') }}

                </div>

                <div class="min-w-0">

                    <flux:heading size="lg">
                        {{ $parent->name }}
                    </flux:heading>

                    <flux:text class="mt-1 truncate text-zinc-500">
                        {{ $parent->email }}
                    </flux:text>

                </div>

            </div>

            <div class="mt-6">

                <flux:button
                    href="{{ route('admin.parents.edit', $parent) }}"
                    variant="ghost"
                    icon="pencil"
                >
                    Edit Profile
                </flux:button>

            </div>

        </flux:card>

    </div>


    {{-- Children --}}
    <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <flux:heading size="lg">
                        Children
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        Students currently assigned to this parent.
                    </flux:text>

                </div>

                <flux:badge color="zinc">

                    {{ $parent->children->count() }}
                    {{ Str::plural('child', $parent->children->count()) }}

                </flux:badge>

            </div>

        </div>


        @if($parent->children->count())

            <div class="divide-y divide-zinc-200 dark:divide-zinc-800">

                @foreach($parent->children as $child)

                    <div class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-zinc-50 dark:hover:bg-zinc-900">

                        <div class="flex min-w-0 items-center gap-3">

                            {{-- Avatar --}}
                            <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-sm font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">

                                {{ collect(explode(' ', $child->name))
                                    ->map(fn ($part) => $part[0] ?? '')
                                    ->take(2)
                                    ->implode('') }}

                            </div>


                            {{-- Student --}}
                            <div class="min-w-0">

                                <flux:text class="truncate font-medium">
                                    {{ $child->name }}
                                </flux:text>

                                @if($child->email)

                                    <flux:text class="truncate text-sm text-zinc-500">
                                        {{ $child->email }}
                                    </flux:text>

                                @else

                                    <flux:text class="text-sm text-zinc-500">
                                        Student
                                    </flux:text>

                                @endif

                            </div>

                        </div>


                        {{-- Status --}}
                        <div class="hidden sm:block">

                            @if($child->status)

                                <flux:badge
                                    color="{{ $child->status === 'active' ? 'emerald' : 'zinc' }}"
                                >
                                    {{ ucfirst($child->status) }}
                                </flux:badge>

                            @endif

                        </div>


                        {{-- View --}}
                        <flux:button
                            href="{{ route('admin.students.show', $child) }}"
                            variant="ghost"
                            size="sm"
                            icon="chevron-right"
                            inset
                        />

                    </div>

                @endforeach

            </div>

        @else

            <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900">

                    <flux:icon
                        name="users"
                        class="size-6 text-zinc-400"
                    />

                </div>

                <flux:heading size="sm">
                    No children assigned
                </flux:heading>

                <flux:text class="mt-1 text-zinc-500">
                    This parent currently has no students assigned.
                </flux:text>

                <flux:button
                    href="{{ route('admin.parents.edit', $parent) }}"
                    variant="ghost"
                    class="mt-4"
                    icon="plus"
                >
                    Assign Children
                </flux:button>

            </div>

        @endif

    </flux:card>


</div>
</x-layouts::app>
