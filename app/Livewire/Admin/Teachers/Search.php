<?php


namespace App\Livewire\Admin\Teachers;

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
        $teachers = User::teachers()->withCount(['students'])
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

        return view('livewire.admin.teachers.search',compact('teachers'));
    }
};
?>
