<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Member;
use Livewire\Component;
use App\Models\PhotoHistory;
use App\Models\StaffHistory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DashboardEditMember extends Component
{
    use WithFileUploads;
    use WithPagination;
    use LivewireAlert;

    public $selectedMember = null;
    public $possibleRoles = [];

    public Member $member;

    public $photo;
    public $status_options = ['Kepala Keluarga', 'Istri', 'Lainnya', 'Anak Ke-1'];

    public $member_id;

    #[Validate('required|string|min:3|max:255')]
    public $name;
    #[Validate('required|date')]
    public $birth;
    #[Validate('required')]
    public $status;
    #[Validate('required|string')]
    public $address;
    #[Validate('required|string|max:255')]
    public $job;
    #[Validate('required|string|max:255')]
    public $position;
    #[Validate('required|string|max:255')]
    public $phone;
    #[Validate('required|string')]
    public $reason_to_join;
    #[Validate('nullable|string|max:255')]
    public $joined_at;
    #[Validate('required|boolean')]
    public $is_dead;

    public function mount(Member $member)
    {
        $this->member = $member;
        $this->possibleRoles = Role::orderBy('name', 'asc')->get(['name', 'id']);


        $this->fill(
            $member->only(['name', 'birth', 'phone', 'status', 'address', 'job', 'position', 'reason_to_join', 'is_dead']),
        );

        $this->updatedJoinedAt();
        $this->updatedBirth();
    }

    public function save()
    {
        $this->validate();


        if ($this->photo) {
            // Store the old photo in the history
            if ($this->member->photo) {
                PhotoHistory::create([
                    'member_id' => $this->member->id,
                    'photo' => $this->member->photo,
                ]);
            }

            // Store the new photo and update the member's photo
            $photoPath = $this->photo->store('public/photos');
            $this->member->photo = $photoPath;
        }

        if ($this->status == 'Kepala Keluarga')
            $this->member_id = null;

        if ($this->position != $this->member->position) {

            $fromRole = Role::findByName($this->member->position);
            $toRole = Role::findByName($this->position);


            StaffHistory::create([
                'member_id' => $this->member->id,
                'role_id' => $fromRole->id,
                'since' => $this->member->last_position_time
            ]);


            $this->member->user->syncRoles([$toRole]);
        }

        $this->member->update(
            $this->only(['name', 'birth', 'phone', 'status', 'address', 'job', 'reason_to_join', 'is_dead', 'member_id'])
        );

        $this->alert('success', 'Berhasil Update Detail Anggota!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function addMoreChild()
    {
        // Find the highest current index for 'Anak Ke-'
        $anakIndexes = collect($this->status_options)
            ->filter(function ($option) {
                return preg_match('/^Anak Ke-\d+$/', $option);
            })
            ->map(function ($option) {
                return (int) str_replace('Anak Ke-', '', $option);
            });

        $nextIndex = $anakIndexes->isNotEmpty() ? $anakIndexes->max() + 1 : 1;
        $this->status_options[] = "Anak Ke-{$nextIndex}";
    }

    public function updatedJoinedAt()
    {
        $this->joined_at = date_format(date_create($this->joined_at), 'Y-m-d');
    }

    public function updatedBirth()
    {
        $this->birth = date_format(date_create($this->birth), 'Y-m-d');
    }

    public function render()
    {
        return view('livewire.dashboard-edit-member', [
            'member' => $this->member
        ]);
    }
}
