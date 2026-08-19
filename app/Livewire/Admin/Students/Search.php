<?php



namespace App\Livewire\Admin\Students;

use App\Models\Student;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;


class Search extends Component

{
    use WithPagination;

    public string $search = '';

    #[Url]
    public string $status = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    public function updatedStatus(): void
    {
        $this->resetPage();
    }
    public function paginationView(): string
    {
        return 'vendor.pagination.tailwind';
    }
    public function mount(): void
    {
        Gate::authorize('viewAny', Student::class);
    }
    public function render()
    {
        // Base query used for search and statistics
        $statsQuery = Student::query()
            ->when($this->search, function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('email', 'ILIKE', "%{$search}%")
                        ->orWhere('phone', 'ILIKE', "%{$search}%");
                });
            });

        // Table query: search + status filter
        $baseQuery = clone $statsQuery;

        if ($this->status === 'no_parent') {
            $baseQuery->whereNull('parent_id');
        }

        if ($this->status === 'no_teachers') {
            $baseQuery->doesntHave('teachers');
        }

        // Students table
        $students = $baseQuery
            ->with(['teachers', 'parent'])
            ->latest()
            ->paginate(20);

        // Statistics

        $totalStudents = (clone $statsQuery)->count();

        $studentsWithoutParent = (clone $statsQuery)
            ->whereNull('parent_id')
            ->count();

        $studentsWithoutTeachers = (clone $statsQuery)
            ->doesntHave('teachers')
            ->count();

        return view('livewire.admin.students.search', compact('students', 'totalStudents', 'studentsWithoutParent', 'studentsWithoutTeachers'));
    }
};
