<?php


namespace App\Livewire\Admin\AcademyClass;


use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AcademyClass;





class Search extends Component

{
    use WithPagination;

    public string $search = '';

#[Url]
public string $status = '';

 public function paginationView(): string
    {
        return 'vendor.pagination.tailwind';
    }
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
public function updatedStatus(): void
{
    $this->resetPage();
}
public function mount(): void
{
    Gate::authorize('viewAny', User::class);
}
public function render()
{
//used by table and stats
   $statsQuery = AcademyClass::query()
        ->when($this->search, function ($query) {
            $search = $this->search;

            $query->where(function ($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->where('name', 'ILIKE', "%{$search}%");
                    });
            });
        });

    // table query — search + status filter
    $baseQuery = (clone $statsQuery)
        ->when($this->status === 'full', function ($query) {
            $query->full();
        })
        ->when($this->status === 'available', function ($query) {
            $query->available();
        });
    $classes = (clone $baseQuery)
        ->with('teacher')
        ->withCount('students')
        ->latest()
        ->paginate(20);

    $allClasses = (clone $statsQuery)
        ->withCount('students')
        ->get(['id', 'capacity']);

    $totalClasses = $allClasses->count();

    $fullClasses = $allClasses
        ->filter(fn ($class) => $class->isFull())
        ->count();

    $totalAvailableSeats = $allClasses
        ->sum(fn ($class) => $class->availableSeats());

    return view(
        'livewire.admin.classes.search',
        compact(
            'classes',
            'totalClasses',
            'fullClasses',
            'totalAvailableSeats'
        )
    );
}

};
?>
