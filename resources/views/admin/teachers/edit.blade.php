<x-layouts::app :title="__('Edit Teacher')">

<div class="max-w-3xl space-y-6">

    <h1 class="text-3xl font-bold">
        Edit Teacher
    </h1>

    <form
        id="teacher-update-form"
        method="POST"
        action="{{ route('admin.teachers.update', $teacher) }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">
                Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $teacher->name) }}"
                class="mt-1 w-full rounded-lg border p-2">
        </div>

        <div>
            <label class="block font-medium">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $teacher->email) }}"
                class="mt-1 w-full rounded-lg border p-2">
        </div>

        <div>
            <label class="block font-medium">
                Phone
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', $teacher->phone) }}"
                class="mt-1 w-full rounded-lg border p-2">
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
                        @selected($teacher->students->contains($student->id))>
                        {{ $student->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                Save Changes
            </button>
        </div>

    </form>

    <form
        action="{{ route('admin.teachers.destroy', $teacher) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this teacher?');">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="rounded-lg bg-red-600 px-5 py-2 text-white hover:bg-red-700">
            Delete Teacher
        </button>

    </form>

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

</x-layouts::app>
