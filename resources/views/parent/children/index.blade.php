<x-layouts::app :title="__('My Children')">

    <div class="flex flex-col gap-6">

        <div>
            <h1 class="text-3xl font-bold">
                My Children
            </h1>

            <p class="text-gray-500">
                View your children's information and academic records.
            </p>
        </div>

        @if($children->isEmpty())

            <div class="rounded-xl border border-dashed p-8 text-center text-gray-500">
                No children have been linked to your account.
            </div>

        @else

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                @foreach($children as $child)

                    <div class="rounded-xl border bg-white p-6 shadow-sm">

                        <div class="space-y-2">

                            <h2 class="text-xl font-semibold">
                                {{ $child->name }}
                            </h2>

                            <p class="text-sm text-gray-500">
                                Student ID:
                                <span class="font-medium text-gray-700">
                                    {{ $child->id }}
                                </span>
                            </p>

                            @if($child->email)
                                <p class="text-sm text-gray-500">
                                    Email:
                                    <span class="text-gray-700">
                                        {{ $child->email }}
                                    </span>
                                </p>
                            @endif

                            @if($child->classroom)
                                <p class="text-sm text-gray-500">
                                    Class:
                                    <span class="text-gray-700">
                                        {{ $child->classroom->name }}
                                    </span>
                                </p>
                            @endif

                        </div>

                        <div class="mt-6">
                            <a href="{{ route('parent.children.show', $child) }}"
                               class="inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                View Details
                            </a>
                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-layouts::app>
