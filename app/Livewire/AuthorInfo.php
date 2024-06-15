<?php

namespace App\Livewire;

use Livewire\Component;

class AuthorInfo extends Component
{
    public $author;
    public $post_created_at;

    public function render()
    {
        return <<<'HTML'
        <div>
            @if($this->author->member)
            <section class="flex flex-row items-center gap-4 dark:bg-yellow-600/20 bg-yellow-600/10 p-4 rounded-xl max-w-md">
                <img src="https://www.material-tailwind.com/img/avatar5.jpg" alt="Author"
                    class="w-20 rounded-full aspect-square">
                <div>
                    <p class="font-semibold text-xl">{{$this->author->name}}</p>
                    <p>{{$this->author->member->position}}</p>
                    <p class="text-sm">{{ $this->post_created_at->format('d M Y') }}</p>
                </div>
            </section>
            @endif
        </div>
        HTML;
    }
}
