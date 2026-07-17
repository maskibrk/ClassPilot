<x-layouts::app :title="__('Create Student')">

<div class="max-w-3xl space-y-6">


<h1 class="text-3xl font-bold">
    Create Student
</h1>



<form method="POST"
      action="{{ route('admin.students.store') }}"
      class="space-y-5 rounded-xl bg-white p-6 shadow">

@csrf



<div>

<label class="block font-medium">
    Teachers
</label>


<select name="teachers[]"
        multiple
        class="mt-1 w-full rounded-lg border p-2">


@foreach($teachers as $teacher)

<option value="{{ $teacher->id }}">
    {{ $teacher->name }}
</option>


@endforeach


</select>


<p class="text-sm text-zinc-500">
    Hold CTRL to select multiple teachers.
</p>


</div>



<div>

<label>Name</label>

<input name="name"
       value="{{ old('name') }}"
       class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label>Email</label>

<input type="email"
       name="email"
       value="{{ old('email') }}"
       class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label>Parent</label>


<select name="parent_id"
        class="mt-1 w-full rounded-lg border p-2">


<option value="">
    No Parent
</option>


@foreach($parents as $parent)

<option value="{{ $parent->id }}">
    {{ $parent->name }}
</option>

@endforeach


</select>


</div>




<div>

<label>Phone</label>

<input name="phone"
       value="{{ old('phone') }}"
       class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label>Status</label>

<select name="status"
        class="mt-1 w-full rounded-lg border p-2">

<option value="active">
    Active
</option>

<option value="inactive">
    Inactive
</option>

</select>


</div>




<button
class="rounded-lg bg-blue-600 px-5 py-2 text-white">

Create Student

</button>


</form>


</div>

</x-layouts::app>
