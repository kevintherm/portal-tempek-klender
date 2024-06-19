<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends Component
{
    use LivewireAlert;

    public $selectedPerm;

    public function show_perm(Permission $permission)
    {
        $this->selectedPerm = $permission;
        $this->dispatch('open-modal', 'perm-details');
    }

    public function delete_post(Permission $permission)
    {
        $permission->delete();

        $this->alert('success', 'Berhasil Menghapus Izin!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.permissions-table', [
            'permissions' => Permission::latest()->get()
        ]);
    }
}
