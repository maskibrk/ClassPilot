<x-layouts::app :title="$teacher->name">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                {{ $teacher->name }}
            </h1>

            <p class="mt-1 text-zinc-500">
                Teacher Profile
            </p>

        </div>

        <a
            href="{{ route('admin.teachers.index') }}"
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
                    <dt class="text-sm text-zinc-500">
                        Name
                    </dt>

                    <dd class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $teacher->name }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">
                        Email
                    </dt>

                    <dd class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $teacher->email }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">
                        Phone
                    </dt>

                    <dd class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $teacher->phone ?? 'Not provided' }}
                    </dd>
                </div>

            </dl>

        </div>


        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Statistics
            </h2>

            <div class="space-y-3">

                <div>

                    <p class="text-sm text-zinc-500">
                        Students
                    </p>

                    <p class="text-4xl font-bold text-blue-600">
                        {{ $teacher->students->count() }}
                    </p>

                </div>

            </div>

        </div>


        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Actions
            </h2>

            <div class="space-y-3">

                <a
                    href="{{route('admin.teachers.edit',$teacher)}}"
                    class="block rounded-lg bg-blue-600 px-4 py-2 text-center text-white hover:bg-blue-700">

                    Edit Teacher

                </a>

                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="block rounded-lg bg-zinc-600 px-4 py-2 text-center text-white hover:bg-zinc-700">

                    All Teachers

                </a>

            </div>

        </div>
<div class="rounded-xl bg-white shadow dark:bg-zinc-900">

    <div class="border-b p-6 dark:border-zinc-700">

        <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">
            Assigned Classes
        </h2>

    </div>


    @if($teacher->academyClasses->isEmpty())

        <div class="p-6 text-zinc-500">
            No classes assigned.
        </div>

    @else

        <table class="min-w-full">

            <thead class="bg-zinc-100 dark:bg-zinc-800">

                <tr>

                    <th class="px-6 py-3 text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">
                        Name
                    </th>

                    <th class="px-6 py-3 text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">
                        Code
                    </th>

                    <th class="px-6 py-3 text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">
                        Students
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach($teacher->academyClasses as $class)

                    <tr class="border-t dark:border-zinc-700">

                        <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                            {{ $class->name }}
                        </td>

                        <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                            {{ $class->code ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                            {{ $class->students->count() }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</div>
    </div>


    <div class="rounded-xl bg-white shadow dark:bg-zinc-900">

        <div class="border-b p-6 dark:border-zinc-700">

            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">
                Assigned Students
            </h2>

        </div>


        @if($teacher->students->isEmpty())

            <div class="p-6 text-zinc-500">
                No students assigned.
            </div>

        @else

            <table class="min-w-full">

                <thead class="bg-zinc-100 dark:bg-zinc-800">

                    <tr>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">
                            Name
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">
                            Email
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($teacher->students as $student)

                        <tr class="border-t dark:border-zinc-700">

                            <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                                {{ $student->name }}
                            </td>

                            <td class="px-6 py-4 text-zinc-900 dark:text-zinc-100">
                                {{ $student->email }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                    {{ ucfirst($student->status) }}
                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @endif

    </div>

</div>

</x-layouts::app>
