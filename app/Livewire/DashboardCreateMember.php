<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Validated;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;

class DashboardCreateMember extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    public $read_only = false;
    public $joined_at, $joined_string;
    public $user_email; // user id is for parent user id

    public $members = [];

    #[Validate]
    public $name = "";
    #[Validate]
    public $age = "";
    #[Validate]
    public $address = "";
    #[Validate]
    public $job = "";
    #[Validate]
    public $position = "";
    #[Validate]
    public $phone = "";
    #[Validate]
    public $reason_to_join = "";
    #[Validate]
    public $is_dead = false;
    #[Validate]
    public $status;

    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];

    public function mount()
    {
        $this->all_members = Member::all();

        // Retrieve saved data from session if available
        $this->members = session()->get('members', [
            [
                'name' => '',
                'status' => '',
                'age' => '',
                'address' => '',
                'job' => '',
                'position' => '',
                'phone' => '',
                'reason_to_join' => '',
                'joined_at' => now()->format('Y-m-d'),
                'photo' => null,
                'is_dead' => false
            ]
        ]);
    }

    public function rules()
    {
        return [
            'members.*.name' => 'required|string|min:3|max:255',
            'members.*.age' => 'required|integer|min:0',
            'members.*.status' => 'required',
            'members.*.address' => 'required|string',
            'members.*.job' => 'required|string|max:255',
            'members.*.position' => 'required|string|max:255',
            'members.*.phone' => 'required|string|max:255|unique:members',
            'members.*.reason_to_join' => 'nullable|string|max:255',
            'members.*.joined_at' => 'required|date',
            'members.*.photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'members.*.is_dead' => 'required|boolean',
        ];
    }

    public function updated($propertyName, $index)
    {
        $this->validateOnly($propertyName);

        // Store member data in session after validation
        session()->put('members', $this->members);
    }

    public function addMember()
    {
        $this->members[] = [
            'name' => '',
            'age' => '',
            'address' => '',
            'status' => '',
            'job' => '',
            'position' => '',
            'phone' => '',
            'reason_to_join' => '',
            'joined_at' => now()->format('Y-m-d'),
            'photo' => null,
            'is_dead' => false
        ];

        // Store updated members array in session
        session()->put('members', $this->members);
    }

    public function removeMember($index)
    {
        unset($this->members[$index]);
        unset($this->photos[$index]);
        $this->members = array_values($this->members); // Re-index the array
        $this->photos = array_values($this->photos); // Re-index the array

        // Store updated members array in session
        session()->put('members', $this->members);
    }

    public function save_members()
    {
        $this->validate();

        foreach ($this->photos as $index => $photo) {
            $path = $photo->store(path: 'public/photos');
            $this->members[$index]['photo'] = $path;
        }

        foreach ($this->members as $index => $member) {
            $savedMember = Member::create([
                'name' => $member['name'],
                'age' => $member['age'],
                'address' => $member['address'],
                'job' => $member['job'],
                'status' => $member['status'],
                'position' => $member['position'],
                'phone' => $member['phone'],
                'reason_to_join' => $member['reason_to_join'],
                'joined_at' => $member['joined_at'],
                'is_dead' => $member['is_dead'],
                'photo' => $member['photo'] ?? null,
                'member_id' => $member['member_id']
            ]);

            // Optionally, you can associate these members with a user if needed
            // $user->members()->save($savedMember);
        }

        $this->alert('success', 'Member baru ditambahkan!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);

        // Clear the inputs and session after saving
        $this->reset(['members', 'photos']);
        session()->forget('members');
        $this->addMember(); // Add a default member form after saving
    }

    public function render()
    {
        return view('livewire.dashboard-create-member');
    }


}
