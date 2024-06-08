<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Particular;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'display_id',
        'chat_name',
        'chat_image_url',
        'anuncio_id',
        'created_at',
        'updated_at',
    ];
        /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'chats';

    public static function getUserChats($userId)
    {
        $chatsIds = ChatParticipants::where('user_id', $userId)->pluck('chat_id');
        $chatsAll = Chat::whereIn('id', $chatsIds)->get();
        return $chatsAll;
    }
    public static function getChatIdFromDisplayId($displayId)
    {
        // Supongo que display_id es único en la tabla Chat
        $chat = Chat::where('display_id', $displayId)->first();
    
        // Verificar si se encontró un chat con el display_id dado
        if ($chat) {
            return $chat->id;
        } else {
            // Si no se encuentra ningún chat, puedes devolver null o lanzar una excepción, según tu lógica de manejo de errores.
            return null; // o throw new Exception("Chat no encontrado para el display_id proporcionado.");
        }
    }
    
    public static function getShowableName($chatId, $currentUserId)
    {
        $chatParticipantsIds = ChatParticipants::getParticipantsFromChat($chatId);
    
        if (count($chatParticipantsIds) === 2) {
            // Obtiene los IDs de los participantes que no son el usuario actual
            $otherParticipantId = array_values(array_diff($chatParticipantsIds->toArray(), [$currentUserId]))[0];
            $otherParticipantData =Particular::getParticularData($otherParticipantId);
            return $otherParticipantData->name.' '.$otherParticipantData->surname;
        }
        
    
        // Si no hay dos participantes o si el usuario actual es uno de los participantes, devuelve el nombre del chat
        $chat = Chat::find($chatId);
        return $chat ? $chat->chat_name : null;
    }

    public static function getChatName($displayId, $currentUserId){
        $chatId=Chat::getChatIdFromDisplayId($displayId);
        $chatParticipantsIds = ChatParticipants::getParticipantsFromChat($chatId);
    
        if (count($chatParticipantsIds) === 2) {
            // Obtiene los IDs de los participantes que no son el usuario actual
            $otherParticipantId = array_values(array_diff($chatParticipantsIds->toArray(), [$currentUserId]))[0];
            $otherParticipantData =Particular::getParticularData($otherParticipantId);
            return $otherParticipantData->name.' '.$otherParticipantData->surname;
        }
        
    
        // Si no hay dos participantes o si el usuario actual es uno de los participantes, devuelve el nombre del chat
        $chat = Chat::find($chatId);
        return $chat ? $chat->chat_name : null;
    }

    public static function getShowablePic($chatId, $currentUserId)
    {
        $chatParticipantsIds = ChatParticipants::getParticipantsFromChat($chatId);
    
        if (count($chatParticipantsIds) === 2) {
            // Obtiene los IDs de los participantes que no son el usuario actual
            $otherParticipantId = array_values(array_diff($chatParticipantsIds->toArray(), [$currentUserId]))[0];
            $otherParticipantData =Particular::getParticularData($otherParticipantId);
            $userId=User::where('id',$otherParticipantData->user_id)->first();
            return $userId;
        }
        
    
        // Si no hay dos participantes o si el usuario actual es uno de los participantes, devuelve el nombre del chat
        $chat = Chat::find($chatId);
        return $chat ? $chat->chat_name : null;
    }
    
    
}
