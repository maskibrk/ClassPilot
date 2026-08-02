<div>

    <label class="block font-medium">
        Class
    </label>

    <select
        id="class-select"
        name="academy_class_id">

        <option value="">Select a class...</option>

        @foreach($classes as $academyClass)

            <option
                value="{{ $academyClass->id }}"
                @selected(old('academy_class_id', $homework->academy_class_id ?? '') == $academyClass->id)>

                {{ $academyClass->name }}

            </option>

        @endforeach

    </select>

    @error('academy_class_id')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

</div>


<div>

    <label class="block font-medium">
        Title
    </label>

    <input
        name="title"
        value="{{ old('title', $homework->title ?? '') }}"
        class="mt-1 w-full rounded-lg border p-2">

    @error('title')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

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
        Homework Attachment
    </label>

    @if(isset($homework) && $homework->file_path)

        @php
            $extension = strtolower(pathinfo($homework->file_path, PATHINFO_EXTENSION));
        @endphp

        <div class="mt-3 rounded-lg border bg-zinc-50 p-4 dark:bg-zinc-800">

            <p class="mb-4 font-medium">
                Current Attachment
            </p>

            @if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))

                <img
                    src="{{ route('teacher.homeworks.preview', $homework) }}"
                    class="max-h-96 rounded-lg border">

            @elseif($extension === 'pdf')

                <iframe
                    src="{{ route('teacher.homeworks.preview', $homework) }}"
                    class="h-[500px] w-full rounded-lg border">
                </iframe>

            @else

                <a
                    href="{{ route('teacher.homeworks.preview', $homework) }}"
                    target="_blank"
                    class="inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                    Open Current Attachment

                </a>

            @endif

        </div>

    @endif


    <label class="mt-5 block font-medium">
        {{ isset($homework) ? 'Replace Attachment' : 'Upload Attachment' }}
    </label>

    <input
        type="file"
        name="file"
        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.png,.jpg,.jpeg"
        class="mt-2 w-full rounded-lg border p-2">

    <p class="mt-2 text-sm text-zinc-500">
        Leave this empty to keep the current attachment.
    </p>

    @error('file')
        <p class="mt-1 text-sm text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>

<div class="pt-2">

    <label class="block font-medium">
        Due Date
    </label>

    <input
        type="date"
        name="due_date"
        value="{{ old('due_date', isset($homework) && $homework->due_date ? $homework->due_date->format('Y-m-d') : '') }}"
        class="mt-1 w-full rounded-lg border p-2">

    @error('due_date')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

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
