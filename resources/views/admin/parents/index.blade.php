<x-layouts::app :title="__('Parents')">

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold">
                    Parents
                </h1>

                <p class="mt-2 text-zinc-500">
                    Manage parent accounts.
                </p>
            </div>

            <a
                href="{{ route('admin.parents.create') }}"
                class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700"
            >
                + Add Parent
            </a>

        </div>


        {{-- Success message --}}
        @if(session('success'))

            <div class="rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- Livewire --}}
        <livewire:admin.parents.search />

    </div>

</x-layouts::app>
