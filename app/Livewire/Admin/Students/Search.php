<?php


namespace App\Livewire\Admin\Students;

use App\Models\Student;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;


class Search extends Component

{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
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
        $students = Student::with(['teachers', 'parent'])
            ->when($this->search, function ($query) {
                $search = $this->search;
//ILIKE is postgres only
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('email', 'ILIKE', "%{$search}%")
                        ->orWhere('phone', 'ILIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20);
$totalStudents=$students->total();
        return view('livewire.admin.students.search',compact('students','totalStudents'));
    }
};
?>


