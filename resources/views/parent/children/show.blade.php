<x-layouts::app :title="$child->name">

    <div class="flex flex-col gap-6">

        <div>
            <h1 class="text-3xl font-bold">
                {{ $child->name }}
            </h1>

            <p class="text-gray-500">
                Student Information
            </p>
        </div>

        <!-- Student Details -->
        <div class="rounded-xl border bg-white p-6 shadow-sm">

            <h2 class="mb-4 text-xl font-semibold">
                Personal Information
            </h2>

            <div class="grid gap-4 md:grid-cols-2">

                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-medium">{{ $child->name }}</p>
                </div>

                @if($child->email)
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $child->email }}</p>
                    </div>
                @endif

                @if($child->phone)
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-medium">{{ $child->phone }}</p>
                    </div>
                @endif

                @if($child->date_of_birth)
                    <div>
                        <p class="text-sm text-gray-500">Date of Birth</p>
                        <p class="font-medium">
                            {{ $child->date_of_birth->format('M d, Y') }}
                        </p>
                    </div>
                @endif

            </div>

        </div>

        <!-- Classes -->
        <div class="rounded-xl border bg-white p-6 shadow-sm">

            <h2 class="mb-4 text-xl font-semibold">
                Classes
            </h2>

            @forelse($child->classes as $class)
                <div class="border-b py-2 last:border-0">
                    {{ $class->name }}      taught by     {{ $class->teacher->name }}


                </div>

            @empty
                <p class="text-gray-500">
                    No classes assigned.
                </p>
            @endforelse

        </div>

        <!-- Teachers -->
        <div class="rounded-xl border bg-white p-6 shadow-sm">

            <h2 class="mb-4 text-xl font-semibold">
                Teachers
            </h2>

            @forelse($child->teachers as $teacher)
                <div class="border-b py-2 last:border-0">
                    {{ $teacher->name }}
                </div>
            @empty
                <p class="text-gray-500">
                    No teachers assigned.
                </p>
            @endforelse

        </div>

        <div>
            <a href="{{ route('parent.children.index') }}"
               class="rounded-lg bg-gray-700 px-5 py-2 text-white hover:bg-gray-800">
                ← Back to Children
            </a>
        </div>

    </div>

</x-layouts::app>
