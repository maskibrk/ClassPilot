<div>

    <label class="block font-medium">
        Class
    </label>

    <select
        id="class-select"
        name="academy_class_id">

        <option value="">
            Select a class...
        </option>

        @foreach($classes as $academyClass)

            <option
                value="{{ $academyClass->id }}"
                @selected(old('academy_class_id', $homework->academy_class_id ?? '') == $academyClass->id)>

                {{ $academyClass->name }}

            </option>

        @endforeach

    </select>

</div>


<div>

    <label class="block font-medium">
        Title
    </label>

    <input
        name="title"
        value="{{ old('title', $homework->title ?? '') }}"
        class="mt-1 w-full rounded-lg border p-2">

</div>


<div>

    <label class="block font-medium">
        Instructions
    </label>

    <textarea
        name="instructions"
        rows="6"
        class="mt-1 w-full rounded-lg border p-2">{{ old('instructions', $homework->instructions ?? '') }}</textarea>

</div>


<div>

    <label class="block font-medium">
        Due Date
    </label>

    <input
        type="date"
        name="due_date"
        value="{{ old('due_date', isset($homework) && $homework->due_date ? $homework->due_date->format('Y-m-d') : '') }}"
        class="mt-1 w-full rounded-lg border p-2">

</div>


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', () => {

    new TomSelect('#class-select', {

        placeholder: 'Select a class...',

        create: false,

    });

});

</script>

@endpush
