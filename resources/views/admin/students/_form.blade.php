<form
    method="POST"
    action="{{ $action }}"
    class="space-y-6"
>
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif


    {{-- Basic Information --}}
    <div class="space-y-5">

        <div>
            <flux:heading size="lg">
                Student Information
            </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                Enter the student's personal and account information.
            </flux:text>
        </div>


        {{-- Name --}}
        <flux:field>

            <flux:label>Name</flux:label>

            <flux:input
                name="name"
                value="{{ old('name', $student->name ?? '') }}"
                placeholder="e.g. Ahmed Benali"
                autocomplete="name"
            />

            @error('name')
                <flux:error>{{ $message }}</flux:error>
            @enderror

        </flux:field>


        {{-- Email --}}
        <flux:field>

            <flux:label>Email</flux:label>

            <flux:input
                type="email"
                name="email"
                value="{{ old('email', $student->email ?? '') }}"
                placeholder="student@example.com"
                autocomplete="email"
            />

            @error('email')
                <flux:error>{{ $message }}</flux:error>
            @enderror

        </flux:field>


        {{-- Phone --}}
        <flux:field>

            <flux:label>Phone</flux:label>

            <flux:input
                type="tel"
                name="phone"
                value="{{ old('phone', $student->phone ?? '') }}"
                placeholder="e.g. 0550 00 00 00"
                autocomplete="tel"
            />

            @error('phone')
                <flux:error>{{ $message }}</flux:error>
            @enderror

        </flux:field>

    </div>


    {{-- Relationships --}}
    <div class="border-t border-zinc-200 pt-6 dark:border-zinc-800">

        <div class="mb-5">

            <flux:heading size="lg">
                Relationships
            </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                Assign the student's parent and teachers.
            </flux:text>

        </div>


        <div class="space-y-5">
{{-- Parent --}}
<flux:field>

    <flux:label>Parent</flux:label>

    <select
        id="parent-select"
        name="parent_id"
    >

        <option value="">
            No Parent
        </option>

        @foreach($parents as $parent)

            <option
                value="{{ $parent->id }}"
                @selected(
                    old(
                        'parent_id',
                        $student->parent_id ?? ''
                    ) == $parent->id
                )
            >
                {{ $parent->name }}
            </option>

        @endforeach

    </select>

    <flux:text class="mt-1 text-xs text-zinc-500">
        Select the parent responsible for this student.
    </flux:text>

    @error('parent_id')
        <flux:error>{{ $message }}</flux:error>
    @enderror

</flux:field>


{{-- Teachers --}}
<flux:field>

    <flux:label>Teachers</flux:label>

    <select
        id="teachers-select"
        name="teachers[]"
        multiple
    >

        @php
            $selectedTeachers = old(
                'teachers',
                isset($student)
                    ? $student->teachers->pluck('id')->toArray()
                    : []
            );
        @endphp

        @foreach($teachers as $teacher)

            <option
                value="{{ $teacher->id }}"
                @selected(in_array($teacher->id, $selectedTeachers))
            >
                {{ $teacher->name }}
            </option>

        @endforeach

    </select>

    <flux:text class="mt-1 text-xs text-zinc-500">
        Select one or more teachers.
    </flux:text>

    @error('teachers')
        <flux:error>{{ $message }}</flux:error>
    @enderror

    @error('teachers.*')
        <flux:error>{{ $message }}</flux:error>
    @enderror

</flux:field>

        </div>

    </div>


    {{-- Account --}}
    <div class="border-t border-zinc-200 pt-6 dark:border-zinc-800">

        <div class="mb-5">

            <flux:heading size="lg">
                Account
            </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                @if($method === 'PUT')
                    Change the student's password if needed.
                @else
                    Set the password the student will use to sign in.
                @endif
            </flux:text>

        </div>


        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

            {{-- Password --}}
            <flux:field>

                <flux:label>
                    {{ $method === 'PUT' ? 'New Password' : 'Password' }}
                </flux:label>

                <flux:input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="new-password"
                />

                @error('password')
                    <flux:error>{{ $message }}</flux:error>
                @enderror

            </flux:field>


            {{-- Confirm --}}
            <flux:field>

                <flux:label>
                    Confirm Password
                </flux:label>

                <flux:input
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    autocomplete="new-password"
                />

                @error('password_confirmation')
                    <flux:error>{{ $message }}</flux:error>
                @enderror

            </flux:field>

        </div>

    </div>


    {{-- Status --}}
    <div class="border-t border-zinc-200 pt-6 dark:border-zinc-800">

        <flux:field>

            <flux:label>Status</flux:label>

            <select
                name="status"
                class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 outline-none transition focus:border-zinc-500 focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100"
            >

                <option
                    value="active"
                    @selected(old('status', $student->status ?? 'active') === 'active')
                >
                    Active
                </option>

                <option
                    value="inactive"
                    @selected(old('status', $student->status ?? '') === 'inactive')
                >
                    Inactive
                </option>

            </select>

            @error('status')
                <flux:error>{{ $message }}</flux:error>
            @enderror

        </flux:field>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col-reverse gap-3 border-t border-zinc-200 pt-6 sm:flex-row sm:justify-end dark:border-zinc-800">

        <flux:button
            href="{{ route('admin.students.index') }}"
            variant="ghost"
        >
            Cancel
        </flux:button>

        <flux:button
            type="submit"
            variant="primary"
            icon="{{ $method === 'PUT' ? 'check' : 'plus' }}"
        >
            {{ $submitLabel }}
        </flux:button>

    </div>

</form>


{{-- Tom Select --}}
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const parentSelect = document.getElementById('parent-select');

    if (parentSelect) {
        new TomSelect(parentSelect, {
            create: false,
            persist: false,
            allowEmptyOption: true,
            placeholder: 'Search parents...',
            maxOptions: 50,
    onItemAdd: function () {
        this.setTextboxValue('');
        this.refreshOptions(false);
    },
        });
    }


    const teachersSelect = document.getElementById('teachers-select');

    if (teachersSelect) {
        new TomSelect(teachersSelect, {
            plugins: ['remove_button'],
            create: false,
            persist: false,
            placeholder: 'Search and select teachers...',
            hideSelected: true,
            closeAfterSelect: false,
            maxOptions: 50,
    onItemAdd: function () {
        this.setTextboxValue('');
        this.refreshOptions(false);
    },
        });
    }

});
</script>

@endpush
