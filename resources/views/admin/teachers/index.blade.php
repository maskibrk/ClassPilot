<x-layouts::app :title="__('Teachers')">

<div class="space-y-6">


<div class="flex justify-between">

<div>

<h1 class="text-3xl font-bold">
Teachers
</h1>

<p class="text-zinc-500">
Manage teachers.
</p>

</div>


<a href="{{ route('admin.teachers.create') }}"
class="rounded-lg bg-green-600 px-5 py-2 text-white">

+ Add Teacher

</a>


</div>



    @if(session('success'))
        <div class="rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Livewire handles only search + table --}}
    <livewire:admin.teachers.search />


</div>
</x-layouts::app>
