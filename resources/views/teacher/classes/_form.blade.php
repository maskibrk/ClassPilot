<div>

    <label class="block font-medium">
        Name
    </label>

    <input
        name="name"
        value="{{ old('name', $class->name ?? '') }}"
        class="mt-1 w-full rounded-lg border p-2">

</div>


<div>

    <label class="block font-medium">
        Description
    </label>

    <textarea
        name="description"
        rows="4"
        class="mt-1 w-full rounded-lg border p-2">{{ old('description', $class->description ?? '') }}</textarea>

</div>


<div>

    <label class="block font-medium">
        Students
    </label>

    <select
        id="students-select"
        name="students[]"
        multiple>

        @foreach($students as $student)

            <option
                value="{{ $student->id }}"
                @selected(
                    isset($class) && $class->students->contains($student->id)
                )>

                {{ $student->name }}

            </option>

        @endforeach

    </select>

</div>


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    new TomSelect('#students-select', {

        plugins: ['remove_button'],

        placeholder: 'Search students...',

        create: false,

    });

});
</script>

@endpush
