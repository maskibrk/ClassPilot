<x-layouts::app :title="__( 'Classes')">

<div class="space-y-6">


    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                 Classes
            </h1>

            <p class="mt-2 text-zinc-500">
                Manage classes .
            </p>
        </div>


        <a href="{{ route('admin.classes.create') }}"
           class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

            + Add Class

        </a>

    </div>



    @if(session('success'))

        <div class="rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>

    @endif
    {{-- Livewire --}}
        <livewire:admin.academy-class.search />



</div>

</x-layouts::app>
