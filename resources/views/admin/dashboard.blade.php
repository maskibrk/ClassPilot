<x-layouts::app :title="__('Admin Dashboard')">

<div class="flex flex-col gap-6">

    <div>
        <h1 class="text-3xl font-bold">
            Admin Dashboard
        </h1>

        <p class="text-gray-500">
            Manage your school system from here.
        </p>
    </div>


    <div class="grid gap-6 md:grid-cols-3">

        <!-- Students -->
        <div class="rounded-xl border p-6 shadow-sm">
            <h2 class="text-xl font-semibold">
                Students
            </h2>

            <p class="mt-2 text-gray-500">
                Manage student accounts and records.
            </p>

            <div class="mt-5 flex gap-3">

                <a href="{{ route('admin.students.index') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2 text-white">
                    View Students
                </a>

                <a href="{{ route('admin.students.create') }}"
                   class="rounded-lg bg-green-600 px-4 py-2 text-white">
                    Add Student
                </a>

            </div>
        </div>


        <!-- Teachers -->
        <div class="rounded-xl border p-6 shadow-sm">

            <h2 class="text-xl font-semibold">
                Teachers
            </h2>

            <p class="mt-2 text-gray-500">
                Manage teachers and assignments.
            </p>


            <div class="mt-5 flex gap-3">

                <a href="{{ route('admin.teachers.index') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2 text-white">
                    View Teachers
                </a>

                <a href="{{ route('admin.teachers.create') }}"
                   class="rounded-lg bg-green-600 px-4 py-2 text-white">
                    Add Teacher
                </a>

            </div>

        </div>


        <!-- Parents -->
        <div class="rounded-xl border p-6 shadow-sm">

            <h2 class="text-xl font-semibold">
                Parents
            </h2>

            <p class="mt-2 text-gray-500">
                Manage parent accounts.
            </p>


            <div class="mt-5 flex gap-3">

                <a href="{{ route('admin.parents.index') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2 text-white">
                    View Parents
                </a>

                <a href="{{ route('admin.parents.create') }}"
                   class="rounded-lg bg-green-600 px-4 py-2 text-white">
                    Add Parent
                </a>

            </div>

        </div>


    </div>


    <!-- Extra admin actions -->

    <div class="grid gap-6 md:grid-cols-4">

        <a href="#"
           class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Classes
        </a>

        <a href="#"
           class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Subjects
        </a>

        <a href="#"
           class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Attendance
        </a>

        <a href="#"
           class="rounded-xl border p-5 text-center hover:bg-gray-100">
            Reports
        </a>

    </div>

</div>

</x-layouts::app>
