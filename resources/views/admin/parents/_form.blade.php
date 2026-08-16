<div class="space-y-6">

    {{-- Name --}}
    <flux:field>
        <flux:label>
            Name
        </flux:label>

        <flux:input
            name="name"
            value="{{ old('name', $parent->name ?? '') }}"
            placeholder="e.g. Ahmed Ben Ali"
        />

        @error('name')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Email --}}
    <flux:field>
        <flux:label>
            Email
        </flux:label>

        <flux:input
            type="email"
            name="email"
            value="{{ old('email', $parent->email ?? '') }}"
            placeholder="e.g. parent@example.com"
        />

        @error('email')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Password --}}
    @if(!isset($parent))

        <flux:field>
            <flux:label>
                Password
            </flux:label>

            <flux:input
                type="password"
                name="password"
                placeholder="Enter password"
            />

            @error('password')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </flux:field>


        {{-- Confirm Password --}}
        <flux:field>
            <flux:label>
                Confirm Password
            </flux:label>

            <flux:input
                type="password"
                name="password_confirmation"
                placeholder="Confirm password"
            />

            @error('password_confirmation')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </flux:field>

    @endif


    {{-- Phone --}}
    <flux:field>
        <flux:label>
            Phone
        </flux:label>

        <flux:input
            type="text"
            name="phone"
            value="{{ old('phone', $parent->phone ?? '') }}"
            placeholder="e.g. +213 555 123 456"
        />

        @error('phone')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Children --}}
    <flux:field>
        <flux:label>
            Children
        </flux:label>

        <div>
            <select
                id="children-select"
                name="children[]"
                multiple
                class="w-full"
            >

                @foreach($students as $student)

                    <option
                        value="{{ $student->id }}"
                        @selected(
                            in_array(
                                $student->id,
                                old(
                                    'children',
                                    isset($parent)
                                        ? $parent->children->pluck('id')->toArray()
                                        : []
                                )
                            )
                        )
                    >
                        {{ $student->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <flux:description>
            Select the children who should be associated with this parent.
        </flux:description>

        @error('children')
            <flux:error>{{ $message }}</flux:error>
        @enderror

        @error('children.*')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </flux:field>


    {{-- Submit --}}
    <div class="flex items-center justify-end gap-3 pt-2">

        <flux:button
            href="{{ route('admin.parents.index') }}"
            variant="ghost"
        >
            Cancel
        </flux:button>

        <flux:button
            type="submit"
            variant="primary"
            icon="check"
        >
            {{ isset($parent) ? 'Update Parent' : 'Create Parent' }}
        </flux:button>

    </div>

</div>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    new TomSelect('#children-select', {
        plugins: ['remove_button'],
        placeholder: 'Search children...',
        create: false,
        maxItems: null,
        searchField: ['text'],
    });

});
</script>
@endpush
