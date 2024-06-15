<?php

namespace App\Livewire;

use Livewire\Component;

class GalleryItem extends Component
{
    public $url;

    public function render()
    {
        return <<<'HTML'
        <div class="overflow-hidden m-0 rounded-lg cursor-pointer grid-item p-2 md:p-4 my-2">
                <img ondblclick="window.open('{{$url}}', '_blank').focus();" class="w-full duration-500 hover:scale-125 transition-all rounded-lg"
                src="{{$url}}" alt="Photo" loading="lazy">
        </div>
        HTML;
    }
}
