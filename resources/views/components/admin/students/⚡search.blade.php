<?php

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
public function mount(): void
{
    Gate::authorize('viewAny', Student::class);
}
    public function render()
    {
        $students = Student::with(['teachers', 'parent'])
            ->when($this->search, function ($query) {
                $search = $this->search;

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('email', 'ILIKE', "%{$search}%")
                        ->orWhere('phone', 'ILIKE', "%{$search}%")
                        ->orWhereHas('parent', function ($query) use ($search) {
                            $query->where('name', 'ILIKE', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(20);

        return $this->view(compact('students'));
    }
};
?>

<div class="space-y-4">

    {{-- Search --}}
    <div class="relative">

        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Search students..."
            class="w-full rounded-lg border border-zinc-300 px-4 py-2
                   dark:border-zinc-700 dark:bg-zinc-800"
        >

        <div
            wire:loading
            wire:target="search"
            class="absolute right-3 top-1/2 -translate-y-1/2"
        >
            Searching...
        </div>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

        <table class="min-w-full">

            <thead class="bg-zinc-100 dark:bg-zinc-800">

                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Teachers</th>
                    <th class="px-6 py-3 text-left">Parent</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>

            </thead>

            <tbody>

            @forelse($students as $student)

                <tr
                    wire:key="student-{{ $student->id }}"
                    class="border-t dark:border-zinc-700"
                >

                    <td class="px-6 py-4">
                        <a
                            href="{{ route('admin.students.show', $student) }}"
                            class="text-blue-600 hover:underline"
                        >
                            {{ $student->name }}
                        </a>
                    </td>

                    <td class="px-6 py-4">
                        @forelse($student->teachers as $teacher)
                            <span class="mr-1 rounded bg-blue-100 px-2 py-1 text-sm">
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
                        {{ ucfirst($student->status) }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-zinc-500">
                        No students found.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="border-t px-6 py-4">
            {{ $students->links() }}
        </div>

    </div>

</div>
