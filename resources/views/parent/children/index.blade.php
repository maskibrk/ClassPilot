<x-layouts::app :title="__('My Children')">

    <div class="flex flex-col gap-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                My Children
            </h1>

            <p class="mt-1 text-zinc-500 dark:text-zinc-400">
                View your children's information and academic records.
            </p>
        </div>


        {{-- No children --}}
        @if($children->isEmpty())

            <div
                class="rounded-xl border border-dashed border-zinc-300 p-8 text-center
                       text-zinc-500 dark:border-zinc-700 dark:text-zinc-400"
            >
                No children have been linked to your account.
            </div>

        @else

            {{-- Children --}}
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                @foreach($children as $child)

                    <div
                        class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm
                               transition hover:shadow-md
                               dark:border-zinc-800 dark:bg-zinc-900"
                    >

                        <div class="space-y-2">

                            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">
                                {{ $child->name }}
                            </h2>

                            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                Student ID:
                                <span class="font-medium text-zinc-700 dark:text-zinc-200">
                                    {{ $child->id }}
                                </span>
                            </p>

                            @if($child->email)

                                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                    Email:
                                    <span class="text-zinc-700 dark:text-zinc-200">
                                        {{ $child->email }}
                                    </span>
                                </p>

                            @endif

                            @if($child->classroom)

                                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                    Class:
                                    <span class="text-zinc-700 dark:text-zinc-200">
                                        {{ $child->classroom->name }}
                                    </span>
                                </p>

                            @endif

                        </div>

                        <div class="mt-6">

                            <a
                                href="{{ route('parent.children.show', $child) }}"
                                class="inline-flex rounded-lg bg-blue-600 px-4 py-2
                                       font-medium text-white transition
                                       hover:bg-blue-700
                                       dark:bg-blue-500 dark:hover:bg-blue-600"
                            >
                                View Details
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-layouts::app>
