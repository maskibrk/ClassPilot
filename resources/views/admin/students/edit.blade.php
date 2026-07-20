<x-layouts::app :title="__('Edit Student')">


<div class="max-w-3xl space-y-6">


<h1 class="text-3xl font-bold">
    Edit Student
</h1>



<form method="POST"
action="{{ route('admin.students.update',$student) }}"
class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">


@csrf
@method('PUT')



<div>

<label class="block font-medium">
    Name
</label>

<input
name="name"
value="{{ old('name',$student->name) }}"
class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label class="block font-medium">
    Email
</label>

<input
type="email"
name="email"
value="{{ old('email',$student->email) }}"
class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label class="block font-medium">
    Phone
</label>

<input
name="phone"
value="{{ old('phone',$student->phone) }}"
class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label class="block font-medium">
    Parent
</label>


<select
name="parent_id"
class="w-full rounded-lg border p-2">


<option value="">
No Parent
</option>


@foreach($parents as $parent)

<option
value="{{ $parent->id }}"
@selected($student->parent_id == $parent->id)>

{{ $parent->name }}

</option>


@endforeach


</select>


</div>





<div>

<label class="block font-medium">
    Teachers
</label>


<select
id="teachers-select"
name="teachers[]"
multiple>


@foreach($teachers as $teacher)

<option
value="{{ $teacher->id }}"
@selected($student->teachers->contains($teacher->id))>

{{ $teacher->name }}

</option>


@endforeach


</select>


</div>




<div>

<label class="block font-medium">
Status
</label>


<select
name="status"
class="w-full rounded-lg border p-2">


<option value="active"
@selected($student->status === 'active')>
Active
</option>


<option value="inactive"
@selected($student->status === 'inactive')>
Inactive
</option>


</select>

</div>




<button
class="rounded-lg bg-blue-600 px-5 py-2 text-white">

Save Changes

</button>


</form>


</div>




@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    new TomSelect('#teachers-select', {

        plugins: ['remove_button'],

        placeholder: 'Search teachers...',

        create: false,

    });

});
</script>

@endpush



</x-layouts::app>
