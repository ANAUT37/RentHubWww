<?php

use App\Models\Messages\ChatMessage;
use Livewire\Component;

class ChatComponent extends Component
{
    public $newMessage;

    public function render()
    {
        // Renderizar la vista del componente
        return view('livewire.chat-component');
    }

    public function sendTextMessage()
    {
        // Validar que el mensaje no esté vacío
        if (!empty($this->newMessage)) {
            // Guardar el mensaje en la base de datos
            ChatMessage::create([
                'text' => $this->newMessage,
                'user_id' => auth()->id(),
                'type'=>'text',
                'answer_to'=>null,
                'file_type'=>null,
                'file_url'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);

            // Limpiar el campo del nuevo mensaje
            $this->newMessage = '';
        }
    }
}

