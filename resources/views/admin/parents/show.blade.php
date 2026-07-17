<x-layouts::app :title="$parent->name">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                {{ $parent->name }}
            </h1>

            <p class="mt-1 text-zinc-500">
                Parent Profile
            </p>

        </div>

        <a
            href="{{ route('admin.parents.index') }}"
            class="rounded-lg bg-zinc-700 px-4 py-2 text-white hover:bg-zinc-800">

            Back

        </a>

    </div>



    <div class="grid gap-6 md:grid-cols-3">

        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Information
            </h2>

            <dl class="space-y-3">

                <div>
                    <dt class="text-sm text-zinc-500">Name</dt>
                    <dd class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $parent->name }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">Email</dt>
                    <dd class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $parent->email }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">Phone</dt>
                    <dd class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $parent->phone ?? 'Not provided' }}
                    </dd>
                </div>

            </dl>

        </div>


        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Statistics
            </h2>

            <p class="text-sm text-zinc-500">
                Children
            </p>

            <p class="text-4xl font-bold text-blue-600">
                {{ $parent->children->count() }}
            </p>

        </div>


        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Actions
            </h2>

            <a
                href="{{ route('admin.parents.index') }}"
                class="block rounded-lg bg-zinc-700 px-4 py-2 text-center text-white">

                Back to Parents

            </a>

        </div>

    </div>



    <div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

        <div class="border-b p-6 dark:border-zinc-700">

            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">
                Children
            </h2>

        </div>

        @if($parent->children->isEmpty())

            <div class="p-6 text-zinc-500">
                No children assigned.
            </div>

        @else

            <table class="min-w-full">

                <thead class="bg-zinc-100 dark:bg-zinc-800">

                    <tr>

                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Teachers</th>
                        <th class="px-6 py-3 text-left">Status</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($parent->children as $child)

                        <tr class="border-t dark:border-zinc-700">

                            <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                                <a
                                    href="{{ route('admin.students.show', $child) }}"
                                    class="text-blue-600 hover:underline dark:text-blue-400">

                                    {{ $child->name }}

                                </a>
                            </td>

                            <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                                {{ $child->teachers->pluck('name')->join(', ') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ ucfirst($child->status) }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @endif

    </div>

</div>

</x-layouts::app>
