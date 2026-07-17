<x-layouts::app :title="__('Students')">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold">
                Students
            </h1>

            <p class="text-zinc-500">
                Manage all students.
            </p>
        </div>


        <a href="{{ route('admin.students.create') }}"
           class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

            + Add Student

        </a>

    </div>


    @if(session('success'))

        <div class="rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>

    @endif



    <div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

        <table class="min-w-full">

            <thead class="bg-zinc-100 dark:bg-zinc-800">

                <tr>

                    <th class="px-6 py-3 text-left">
                        Name
                    </th>

                    <th class="px-6 py-3 text-left">
                        Teachers
                    </th>

                    <th class="px-6 py-3 text-left">
                        Parent
                    </th>

                    <th class="px-6 py-3 text-left">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

            @forelse($students as $student)

                <tr class="border-t dark:border-zinc-700">


                    <td class="px-6 py-4 font-medium">
<a
    href="{{ route('admin.students.show', $student) }}"
    class="font-medium text-blue-600 hover:underline dark:text-blue-400">
    {{ $student->name }}
</a>
                    </td>



                    <td class="px-6 py-4">

                        @forelse($student->teachers as $teacher)

                            <span class="mr-1 rounded bg-blue-100 px-2 py-1 text-sm text-blue-700">
                                {{ $teacher->name }}
                            </span>

                        @empty

                            <span class="text-zinc-500">
                                No teacher
                            </span>

                        @endforelse

                    </td>



                    <td class="px-6 py-4">
                        {{ $student->parent?->name ?? 'No parent' }}
                    </td>



                    <td class="px-6 py-4">

                        <span class="rounded-full px-3 py-1 text-sm
                        {{ $student->status === 'active'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">

                            {{ ucfirst($student->status) }}

                        </span>

                    </td>


                </tr>


            @empty

                <tr>

                    <td colspan="4"
                        class="px-6 py-10 text-center text-zinc-500">

                        No students found.

                    </td>

                </tr>

            @endforelse


            </tbody>

        </table>

    </div>


</div>

</x-layouts::app>
