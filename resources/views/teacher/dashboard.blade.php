<x-layouts::app :title="__('Teacher Dashboard')">

<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold">
            Teacher Dashboard
        </h1>

        <p class="mt-2 text-gray-500">
            Manage your students from here.
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-3">

        <div class="rounded-xl border bg-white p-6 shadow-sm">

            <h2 class="text-xl font-semibold">
                Students
            </h2>

            <p class="mt-2 text-gray-500">
                View and manage your students.
            </p>

            <div class="mt-6 flex gap-3">

                <a
                    href="{{ route('teacher.students.index') }}"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    View Students
                </a>

                <a
                    href="{{ route('teacher.students.create') }}"
                    class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                    Add Student
                </a>

            </div>

        </div>

    </div>

    <div class="grid gap-6 md:grid-cols-4">

        <a href="#" class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Classes
        </a>

        <a href="#" class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Subjects
        </a>

        <a href="#" class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Attendance
        </a>

        <a href="#" class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Reports
        </a>

    </div>

</div>

</x-layouts::app>
