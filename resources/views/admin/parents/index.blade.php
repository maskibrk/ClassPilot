<x-layouts::app :title="__('Parents')">

<div class="space-y-6">


    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">
                Parents
            </h1>

            <p class="mt-2 text-zinc-500">
                Manage parent accounts.
            </p>

        </div>


        <a href="{{ route('admin.parents.create') }}"
           class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

            + Add Parent

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
                        Email
                    </th>

                    <th class="px-6 py-3 text-left">
                        Children
                    </th>

                </tr>


            </thead>



            <tbody>


            @forelse($parents as $parent)


                <tr class="border-t dark:border-zinc-700">


                    <td class="px-6 py-4">

<a
    href="{{ route('admin.parents.show', $parent) }}"
    class="font-medium text-blue-600 hover:underline dark:text-blue-400">
    {{ $parent->name }}
</a>
                    </td>


                    <td class="px-6 py-4">

                        {{ $parent->email }}

                    </td>


                    <td class="px-6 py-4">

                        {{ $parent->children_count }}

                    </td>


                </tr>


            @empty


                <tr>

                    <td colspan="3"
                        class="px-6 py-10 text-center text-zinc-500">

                        No parents found.

                    </td>

                </tr>


            @endforelse


            </tbody>


        </table>


    </div>


</div>


</x-layouts::app>
