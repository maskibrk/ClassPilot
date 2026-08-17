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
            Teacher Information
        </flux:heading>

        <flux:text class="mt-1 text-zinc-500">
            Enter the teacher's account and contact information.
        </flux:text>
    </div>


    {{-- Name --}}
    <flux:field>

        <flux:label>Name</flux:label>

        <flux:input
            name="name"
            value="{{ old('name', $teacher->name ?? '') }}"
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
            value="{{ old('email', $teacher->email ?? '') }}"
            placeholder="teacher@example.com"
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
            value="{{ old('phone', $teacher->phone ?? '') }}"
            placeholder="e.g. 0550 00 00 00"
            autocomplete="tel"
        />

        @error('phone')
            <flux:error>{{ $message }}</flux:error>
        @enderror

    </flux:field>

</div>


{{-- Password --}}
<div class="border-t border-zinc-200 pt-6 dark:border-zinc-800">

    <div class="mb-5">

        <flux:heading size="lg">
            Password
        </flux:heading>

        <flux:text class="mt-1 text-zinc-500">
            @if($method === 'PUT')
                Leave these fields empty to keep the current password.
            @else
                Set a password for the teacher's account.
            @endif
        </flux:text>

    </div>


    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

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


{{-- Students: Edit Only --}}
@if($method === 'PUT')

    <div class="border-t border-zinc-200 pt-6 dark:border-zinc-800">

        <div class="mb-5">

            <flux:heading size="lg">
                Students
            </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                Assign students to this teacher.
            </flux:text>

        </div>


        <flux:field>

            <flux:label>
                Assigned Students
            </flux:label>

            <select
                id="students-select"
                name="students[]"
                multiple
            >

                @foreach($students as $student)

                    <option
                        value="{{ $student->id }}"
                        @selected(
                            in_array(
                                $student->id,
                                old(
                                    'students',
                                    $teacher->students->pluck('id')->toArray()
                                )
                            )
                        )
                    >
                        {{ $student->name }}
                    </option>

                @endforeach

            </select>

            @error('students')
                <flux:error>{{ $message }}</flux:error>
            @enderror

            @error('students.*')
                <flux:error>{{ $message }}</flux:error>
            @enderror

        </flux:field>

    </div>

@endif


{{-- Actions --}}
<div class="flex flex-col-reverse gap-3 border-t border-zinc-200 pt-6 sm:flex-row sm:justify-end dark:border-zinc-800">

    <flux:button
        href="{{ route('admin.teachers.index') }}"
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

@if($method === 'PUT')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const element = document.getElementById('students-select');

        if (!element) {
            return;
        }

        new TomSelect(element, {
            plugins: ['remove_button'],
            placeholder: 'Search students...',
            create: false,
            maxOptions: 50,
        });

    });
</script>
@endpush

@endif
