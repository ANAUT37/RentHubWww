<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {   
        $coversations=[];
        return view('livewire.chat.index',
    [
        'conversations'=>$coversations
    ]);
    }
}
