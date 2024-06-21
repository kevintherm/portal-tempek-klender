<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DashboardMembers extends Component
{

    use WithPagination;
    use LivewireAlert;

    public $selectedMember;
    public $showMembersFamily = false;

    public function delete_member(Member $member)
    {
        $member->user->delete();
        $member->delete();

        $this->alert('success', 'Berhasil dihapus dari daftar!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    function show_member($id)
    {
        $this->showMembersFamily = false;
        $this->dispatch('open-modal', 'show-member');

        // Query only for different member
        if ($this->selectedMember && $this->selectedMember->id === $id)
            return;

        $this->selectedMember = Member::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.dashboard-members', [
            'members' => Member::filters(request(['name', 'phone', 'address', 'position']))->paginate(10)
        ]);
    }

    function toggleShowMembersFamily()
    {
        $this->showMembersFamily = !$this->showMembersFamily;
    }
}
