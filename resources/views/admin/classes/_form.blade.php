<div>

    <label class="block font-medium">
        Teacher
    </label>

    <select
        id="teacher-select"
        name="teacher_id">

        <option value="">
            Select a teacher...
        </option>

        @foreach($teachers as $teacher)

            <option
                value="{{ $teacher->id }}"
                @selected(old('teacher_id', $class->teacher_id ?? '') == $teacher->id)>

                {{ $teacher->name }}

            </option>

        @endforeach

    </select>

</div>


<div>

    <label class="block font-medium">
        Name
    </label>

<input
    name="name"
    value="{{ old('name', $class->name ?? '') }}"
    class="mt-1 w-full rounded-lg border border-zinc-300 bg-white p-2
           dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
</div>


<div>

    <label class="block font-medium">
        Description
    </label>
<textarea
    name="description"
    rows="4"
    class="mt-1 w-full rounded-lg border border-zinc-300 bg-white p-2
           dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('description', $class->description ?? '') }}</textarea>
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
                    in_array(
                        $student->id,
                        old(
                            'students',
                            isset($class)
                                ? $class->students->pluck('id')->toArray()
                                : []
                        )
                    )
                )>

                {{ $student->name }}

            </option>

        @endforeach

    </select>

</div>


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', () => {

    new TomSelect('#teacher-select', {
        placeholder: 'Select a teacher...',
        create: false,
    });

    new TomSelect('#students-select', {
        plugins: ['remove_button'],
        placeholder: 'Search students...',
        create: false,
    });

});
</script>

@endpush
