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



<div class="overflow-hidden rounded-xl bg-white shadow">


<table class="min-w-full">


<thead class="bg-zinc-100">

<tr>

<th class="px-6 py-3 text-left">
Name
</th>


<th class="px-6 py-3 text-left">
Email
</th>


<th class="px-6 py-3 text-left">
Students
</th>


</tr>

</thead>



<tbody>


@foreach($teachers as $teacher)

<tr class="border-t">


<td class="px-6 py-4">
{{ $teacher->name }}
</td>


<td class="px-6 py-4">
{{ $teacher->email }}
</td>


<td class="px-6 py-4">
{{ $teacher->students_count }}
</td>


</tr>


@endforeach


</tbody>


</table>


</div>


</div>

</x-layouts::app>
