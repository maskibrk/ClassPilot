<?php

namespace App\Livewire\Admin\AcademyClass;


use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AcademyClass;




class Search extends Component

{
    use WithPagination;

    public string $search = '';

 public function paginationView(): string
    {
        return 'vendor.pagination.tailwind';
    }
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
public function mount(): void
{
    Gate::authorize('viewAny', User::class);
}
public function render()
{
    $baseQuery = AcademyClass::query()
        ->when($this->search, function ($query) {
            $search = $this->search;

            $query->where(function ($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->where('name', 'ILIKE', "%{$search}%");
                    });
            });
        });

    $classes = (clone $baseQuery)
        ->with('teacher')
        ->withCount('students')
        ->latest()
        ->paginate(20);

    $allClasses = (clone $baseQuery)
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
