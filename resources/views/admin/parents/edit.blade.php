<x-layouts::app :title="__('Edit Parent')">


<div class="max-w-3xl space-y-6">


<h1 class="text-3xl font-bold">
    Edit Parent
</h1>



<form method="POST"
action="{{ route('admin.parents.update', $parent) }}"
class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">


@csrf
@method('PUT')



<div>

<label class="block font-medium">
    Name
</label>

<input
name="name"
value="{{ old('name',$parent->name) }}"
class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label class="block font-medium">
    Email
</label>

<input
type="email"
name="email"
value="{{ old('email',$parent->email) }}"
class="mt-1 w-full rounded-lg border p-2">

</div>




<div>

<label class="block font-medium">
    Phone
</label>

<input
name="phone"
value="{{ old('phone',$parent->phone) }}"
class="mt-1 w-full rounded-lg border p-2">

</div>





<div>

<label class="block font-medium">
    Children
</label>


<select
id="children-select"
name="children[]"
multiple>


@foreach($students as $student)

<option
value="{{ $student->id }}"
@selected($parent->children->contains($student->id))>

{{ $student->name }}

</option>


@endforeach


</select>


</div>




<button
class="rounded-lg bg-blue-600 px-5 py-2 text-white">

Save Changes

</button>


</form>

<form
    action="{{ route('admin.parents.destroy', $parent) }}"
    method="POST"
    class="mt-4"
    onsubmit="return confirm('Are you sure you want to delete this parent?');">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="rounded-lg bg-red-600 px-5 py-2 text-white hover:bg-red-700">
        Delete Parent
    </button>

</form>

</div>




@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    new TomSelect('#children-select', {

        plugins: ['remove_button'],

        placeholder: 'Search children...',

        create: false,

    });

});
</script>

@endpush


</x-layouts::app>
