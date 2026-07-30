<x-layouts::app :title="__( 'Classes')">

<div class="space-y-6">


    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                 Classes
            </h1>

        </div>



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
                        Teacher
                    </th>




                </tr>

            </thead>



            <tbody>


            @forelse($classes as $class)


                <tr class="border-t dark:border-zinc-700">


                    <td class="px-6 py-4 font-medium">

                        <a
                            href="{{ route('student.classes.show', $class) }}"
                            class="font-medium text-blue-600 hover:underline dark:text-blue-400">

                            {{ $class->name }}

                        </a>

                    </td>



                    <td class="px-6 py-4">

                        <a
                            href="{{ route('student.teachers.show', $class->teacher) }}"
                            class="font-medium text-blue-600 hover:underline dark:text-blue-400">


                        {{ $class->teacher->name }}
                        </a>

                    </td>




                </tr>


            @empty


                <tr>

                    <td colspan="5"
                        class="px-6 py-10 text-center text-zinc-500">

                        No classes found.

                    </td>

                </tr>


            @endforelse


            </tbody>


        </table>


    </div>


</div>

</x-layouts::app>
