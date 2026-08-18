<div class="space-y-6">

    {{-- Teacher --}}
<flux:field>
    <flux:label>
        Teacher
    </flux:label>

    <select
        id="teacher-select"
        name="teacher_id"
        class="w-full"
    >
        <option value="">
            Select a teacher...
        </option>

        @foreach($teachers as $teacher)
            <option
                value="{{ $teacher->id }}"
                @selected(old('teacher_id', $class->teacher_id ?? '') == $teacher->id)
            >
                {{ $teacher->name }}
            </option>
        @endforeach
    </select>

    @error('teacher_id')
        <flux:error>{{ $message }}</flux:error>
    @enderror
</flux:field>
    {{-- Name --}}
    <flux:field>
        <flux:label>
            Class Name
        </flux:label>

        <flux:input
            name="name"
            value="{{ old('name', $class->name ?? '') }}"
            placeholder="e.g. Mathematics - Grade 10"
        />

        @error('name')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Capacity --}}
    <flux:field>
        <flux:label>
            Capacity
        </flux:label>

        <flux:input
            type="number"
            name="capacity"
            value="{{ old('capacity', $class->capacity ?? '') }}"
            placeholder="e.g. 25"
            min="1"
        />

        <flux:description>
            Maximum number of students allowed in this class.
        </flux:description>

        @error('capacity')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Description --}}
    <flux:field>
        <flux:label>
            Description
        </flux:label>

        <flux:textarea
            name="description"
            rows="4"
            placeholder="Add a description for this class..."
        >{{ old('description', $class->description ?? '') }}</flux:textarea>

        @error('description')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Students --}}
    <flux:field>
        <flux:label>
            Students
        </flux:label>

        <div>
            <select
                id="students-select"
                name="students[]"
                multiple
                class="w-full"
            >
            </select>
        </div>

        <flux:description>
            Select the students who should be enrolled in this class.
        </flux:description>

        @error('students')
            <flux:error>{{ $message }}</flux:error>
        @enderror

        @error('students.*')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Submit --}}
    <div class="flex items-center justify-end gap-3 pt-2">

        <flux:button
            href="{{ route('admin.classes.index') }}"
            variant="ghost"
        >
            Cancel
        </flux:button>

        <flux:button
            type="submit"
            variant="primary"
            icon="check"
        >
            {{ isset($class) ? 'Update Class' : 'Create Class' }}
        </flux:button>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const teacherSelect = new TomSelect('#teacher-select', {
        placeholder: 'Search teacher...',
        create: false,
        maxItems: 1,
        searchField: ['text'],
    });

    const studentsSelect = new TomSelect('#students-select', {
        plugins: ['remove_button'],
        placeholder: 'Search students...',
        create: false,
    });

    async function loadStudents(teacherId, selectedStudents = []) {

        studentsSelect.clear();
        studentsSelect.clearOptions();

        if (!teacherId) {
            return;
        }

        try {
            const response = await fetch(
                `/admin/teachers/${teacherId}/students`
            );

            if (!response.ok) {
                throw new Error('Failed to load students');
            }

            const students = await response.json();

            students.forEach(student => {
                studentsSelect.addOption({
                    value: student.id,
                    text: student.name,
                });
            });

            studentsSelect.refreshOptions(false);

            selectedStudents.forEach(studentId => {
                if (studentsSelect.options[studentId]) {
                    studentsSelect.addItem(studentId);
                }
            });

        } catch (error) {
            console.error(error);
        }
    }

    teacherSelect.on('change', function(teacherId) {
        loadStudents(teacherId);
    });

    // Load students for the currently selected teacher
    const initialTeacher = teacherSelect.getValue();

    if (initialTeacher) {

        const selectedStudents = @json(
            old(
                'students',
                isset($class)
                    ? $class->students->pluck('id')->toArray()
                    : []
            )
        );

        loadStudents(initialTeacher, selectedStudents);
    }

});
</script>
@endpush

