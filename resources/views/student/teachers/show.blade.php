<x-layouts::app :title="__('Teacher Details')">

<div class="space-y-6">

    <div>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
            Teacher Details
        </h1>

        <p class="mt-2 text-zinc-500">
            View information about your teacher.
        </p>
    </div>


    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="space-y-5">


            <div>
                <h2 class="text-sm text-zinc-500">
                    Name
                </h2>

                <p class="text-lg font-semibold text-zinc-900 dark:text-white">
                    {{ $teacher->name }}
                </p>
            </div>



            <div>
                <h2 class="text-sm text-zinc-500">
                    Email
                </h2>

                <p class="text-lg text-zinc-900 dark:text-white">
                    {{ $teacher->email }}
                </p>
            </div>



            <div>
                <h2 class="text-sm text-zinc-500">
                    Status
                </h2>

                <span class="inline-block rounded-full px-3 py-1 text-sm
                    {{ $teacher->status === 'active'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700' }}">

                    {{ ucfirst($teacher->status) }}

                </span>
            </div>



            @if($teacher->phone)

            <div>
                <h2 class="text-sm text-zinc-500">
                    Phone
                </h2>

                <p class="text-lg text-zinc-900 dark:text-white">
                    {{ $teacher->phone }}
                </p>
            </div>

            @endif



            @if($teacher->address)

            <div>
                <h2 class="text-sm text-zinc-500">
                    Address
                </h2>

                <p class="text-lg text-zinc-900 dark:text-white">
                    {{ $teacher->address }}
                </p>
            </div>

            @endif


        </div>


        <div class="mt-6">

            <a href="{{ route('student.teachers.index') }}"
               class="rounded-lg bg-zinc-200 px-5 py-2 text-zinc-800 hover:bg-zinc-300 dark:bg-zinc-700 dark:text-white">

                ← Back to Teachers

            </a>

        </div>


    </div>


</div>

</x-layouts::app>
