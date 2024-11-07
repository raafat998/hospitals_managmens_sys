<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Createchat extends Component
{
    public function render()
    {
        return view(view: 'livewire.chat.createchat')->layout('layout.side-menu');

    }
}
