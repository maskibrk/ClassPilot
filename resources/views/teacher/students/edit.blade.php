<x-layouts::app :title="'Edit '.$student->name">

    <div class="space-y-6">

        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                    Edit {{ $student->name }}
                </h1>

                <p class="mt-1 text-zinc-500">
                    Update student information
                </p>
            </div>

            <a
                href="{{ route('teacher.students.show', $student) }}"
                class="rounded-lg bg-zinc-700 px-4 py-2 text-white hover:bg-zinc-800">

                Cancel

            </a>

        </div>

        <form
            action="{{ route('teacher.students.update', $student) }}"
            method="POST"
            class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900 space-y-6">

            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">

                {{-- Name --}}
                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Name
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $student->name) }}"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $student->email) }}"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Phone
                    </label>

                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        value="{{ old('phone', $student->phone) }}"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">

                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Parent --}}
                <div>
                    <label for="parent_id" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Parent
                    </label>

                    <select
                        id="parent_id"
                        name="parent_id"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">

                        <option value="">No parent</option>

                        @foreach($parents as $parent)
                            <option
                                value="{{ $parent->id }}"
                                @selected(old('parent_id', $student->parent_id) == $parent->id)>
                                {{ $parent->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('parent_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">

                        <option value="active"
                            @selected(old('status', $student->status) === 'active')>
                            Active
                        </option>

                        <option value="inactive"
                            @selected(old('status', $student->status) === 'inactive')>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Join Date --}}
                <div>
                    <label for="join_date" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Join Date
                    </label>

                    <input
                        id="join_date"
                        name="join_date"
                        type="date"
                        value="{{ old('join_date', optional($student->join_date)->format('Y-m-d')) }}"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">

                    @error('join_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Notes --}}
            <div>
                <label for="notes" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    Notes
                </label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="5"
                    class="w-full rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('notes', $student->notes) }}</textarea>

                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('teacher.students.show', $student) }}"
                    class="rounded-lg border border-zinc-300 px-4 py-2 hover:bg-zinc-100 dark:border-zinc-700 dark:hover:bg-zinc-800">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</x-layouts::app>
