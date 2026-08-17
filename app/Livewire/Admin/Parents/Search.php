<?php



namespace App\Livewire\Admin\Parents;

use App\Models\Student;
use App\Models\User;
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
    Gate::authorize('viewAny', User::class);
}
public function render()
{
    $parentsQuery = User::parents()
        ->when($this->search, function ($query) {
            $search = $this->search;

            $query->where(function ($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('email', 'ILIKE', "%{$search}%")
                    ->orWhere('phone', 'ILIKE', "%{$search}%");
            });
        });

    $parents = (clone $parentsQuery)
        ->withCount('children')
        ->latest()
        ->paginate(20);

$totalParents = $parents->total();

    $totalChildren = Student::whereHas('parent', function ($query) use ($parentsQuery) {
        // Apply the same parent filtering here
    })->count();

    return view(
        'livewire.admin.parents.search',
        compact(
            'parents',
            'totalParents',
            'totalChildren'
        )
    );
}
};
?>
