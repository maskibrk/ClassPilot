<x-layouts::app :title="__('Class Details')">

<div class="space-y-6">

    <div>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
            Class Details
        </h1>

        <p class="mt-2 text-zinc-500">
            View information about your class.
        </p>
    </div>


    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="space-y-5">


            <div>
                <h2 class="text-sm text-zinc-500">
                    Name
                </h2>

                <p class="text-lg font-semibold text-zinc-900 dark:text-white">
                {{ $class->name }}
                </p>
            </div>
            <div>
                <h2 class="text-sm text-zinc-500">
                    Teacher
                </h2>

                <p class="text-lg font-semibold text-zinc-900 dark:text-white">
                {{ $class->teacher->name }}
                </p>
            </div>

        </div>

        <div class="mt-6">

            <a href="{{ route('student.classes.index') }}"
               class="rounded-lg bg-zinc-200 px-5 py-2 text-zinc-800 hover:bg-zinc-300 dark:bg-zinc-700 dark:text-white">

                ← Back to Classes

            </a>

        </div>


    </div>


</div>

</x-layouts::app>
