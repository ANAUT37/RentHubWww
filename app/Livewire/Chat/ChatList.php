<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatList extends Component
{
    public function render()
    {
        $coversations = [];
        return view('livewire.chat.chat-list',    [
            'conversations' => $coversations
        ]);
    }
}
