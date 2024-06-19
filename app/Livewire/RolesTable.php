<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesTable extends Component
{
    use LivewireAlert;

    public $selectedRole;

    public function show_role(Role $role)
    {
        $this->selectedRole = $role;
        $this->dispatch('open-modal', 'role-details');
    }

    public function delete_role(Role $role)
    {
        $role->delete();

        $this->alert('success', 'Berhasil Menghapus Jabatan!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.roles-table', [
            'roles' => Role::latest()->get(),
        ]);
    }
}
