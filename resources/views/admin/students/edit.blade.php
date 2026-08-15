<x-layouts::app :title="__('Edit Student')">

    <div class="max-w-3xl space-y-6">

        <h1 class="text-3xl font-bold">
            Edit Student
        </h1>

        <!-- Update Student Form -->
        <form
            method="POST"
            action="{{ route('admin.students.update', $student) }}"
            class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $student->name) }}"
                    class="mt-1 w-full rounded-lg border p-2">
            </div>

            <div>
                <label class="block font-medium">Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $student->email) }}"
                    class="mt-1 w-full rounded-lg border p-2">
            </div>

            <div>
                <label class="block font-medium">Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $student->phone) }}"
                    class="mt-1 w-full rounded-lg border p-2">
            </div>

            <div>
                <label class="block font-medium">Parent</label>

                <select
                    name="parent_id"
                    class="w-full rounded-lg border p-2">

                    <option value="">No Parent</option>

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
    <label class="block font-medium">Teachers</label>

    <select
        id="teachers-select"
        name="teachers[]"
        multiple
        class="w-full rounded-lg border p-2">

        @foreach($teachers as $teacher)
            <option
                value="{{ $teacher->id }}"
                data-email="{{ $teacher->email }}"
                data-initials="{{ collect(explode(' ', $teacher->name))->map(fn($p) => Str::substr($p, 0, 1))->take(2)->implode('') }}"
                @selected($student->teachers->contains($teacher->id))>
                {{ $teacher->name }}
            </option>
        @endforeach

    </select>
</div>
            <div>
                <label class="block font-medium">Status</label>

                <select
                    name="status"
                    class="w-full rounded-lg border p-2">

                    <option
                        value="active"
                        @selected($student->status === 'active')>
                        Active
                    </option>

                    <option
                        value="inactive"
                        @selected($student->status === 'inactive')>
                        Inactive
                    </option>

                </select>
            </div>

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                Save Changes
            </button>

        </form>

        <!-- Delete Student Form -->
<x-confirm-delete
    name="{{ $student->name }}"
    action="{{ route('admin.students.destroy', $student) }}"
    modal="delete-student-{{ $student->id }}"
/>

    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#teachers-select', {
        plugins: ['remove_button'],
        create: false,
        persist: false,
        placeholder: 'Select teachers...',
        hideSelected: true,
        closeAfterSelect: false,
    });
});
</script>

@endpush

</x-layouts::app>

