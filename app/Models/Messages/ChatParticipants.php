<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Messages\Chat;

class ChatParticipants extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'chat_id',
        'created_at',
        'updated_at',
    ];
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'chats_participants';

    public static function getUserChats($userId)
    {
        return  ChatParticipants::where('user_id', $userId)->pluck('chat_id');
    }
    public static function getParticipantsFromChat($chatId)
    {   
        
        return ChatParticipants::where('chat_id', $chatId)->pluck('user_id');
    }
}
