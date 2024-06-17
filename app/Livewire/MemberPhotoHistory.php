<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use App\Models\PhotoHistory;

class MemberPhotoHistory extends Component
{

    public Member $member;

    public function mount(Member $member)
    {
        $this->member = $member;
    }

    public function render()
    {
        return view('livewire.member-photo-history', [
            'photo_histories' => $this->member->photo_histories,
        ]);
    }
}
