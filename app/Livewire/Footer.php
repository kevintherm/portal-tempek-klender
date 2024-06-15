<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return <<<'HTML'
        <footer class="px-8 py-28">
            <div class="container mx-auto flex flex-col items-center">
                <div class="flex flex-wrap items-center justify-center gap-8 pb-8">
                    <ul>
                        <li>
                            <a href="#" class="font-semibold text-gray-500 transition-colors hover:text-gray-900">
                                <p>Link</p>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="#" class="font-semibold text-gray-500 transition-colors hover:text-gray-900">
                                <p>Link</p>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="#" class="font-semibold text-gray-500 transition-colors hover:text-gray-900">
                                <p>Link</p>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="#" class="font-semibold text-gray-500 transition-colors hover:text-gray-900">
                                <p>Link</p>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="#" class="font-semibold text-gray-500 transition-colors hover:text-gray-900">
                                <p>Link</p>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="#" class="font-semibold text-gray-500 transition-colors hover:text-gray-900">
                                <p>Link</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <p color="blue-gray" class="mt-6 text-sm font-normal text-gray-500">
                    Copyright &copy; {{ date('Y') }} Tempek Klender
                </p>
            </div>
        </footer>
        HTML;
    }
}
