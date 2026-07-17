<x-layouts::app :title="__('Create Parent')">


<div class="max-w-3xl space-y-6">


    <div>

        <h1 class="text-3xl font-bold">
            Create Parent
        </h1>

        <p class="mt-2 text-zinc-500">
            Add a new parent account.
        </p>

    </div>



    <form method="POST"
          action="{{ route('admin.parents.store') }}"
          class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">


        @csrf



        <div>

            <label class="block font-medium">
                Name
            </label>


            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="mt-1 w-full rounded-lg border p-2">


            @error('name')

                <p class="text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror


        </div>





        <div>

            <label class="block font-medium">
                Email
            </label>


            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="mt-1 w-full rounded-lg border p-2">


            @error('email')

                <p class="text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror


        </div>





        <div>

            <label class="block font-medium">
                Password
            </label>


            <input
                type="password"
                name="password"
                class="mt-1 w-full rounded-lg border p-2">


            @error('password')

                <p class="text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror


        </div>

<div>

<label>Confirm Password</label>

<input type="password"
name="password_confirmation"
class="w-full rounded-lg border p-2">

</div>





        <div>

            <label class="block font-medium">
                Phone
            </label>


            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="mt-1 w-full rounded-lg border p-2">

        </div>

<div>

    <label class="block font-medium">
        Children
    </label>


    <select
        id="children-select"
        name="students[]"
        multiple
        class="mt-1 w-full rounded-lg border p-2">

        @foreach($students as $student)

            <option value="{{ $student->id }}">
                {{ $student->name }}
            </option>

        @endforeach

    </select>


</div>



        <button
            type="submit"
            class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

            Create Parent

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

        maxItems: null,

        searchField: 'text',

    });

});
</script>

@endpush

</x-layouts::app>

