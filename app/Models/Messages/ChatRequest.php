<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Messages\ChatParticipants;
use App\Models\Particular;

class ChatRequest extends Model
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
        'sender_id',
        'receiver_id',
        'chat_image_url',
        'anuncio_id',
        'created_at',
        'updated_at',
        'request_text'
    ];
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'chats_request';

    public static function getUserChatRequest($userId)
    {
        $chatsRequestAll = ChatRequest::where('receiver_id', $userId)
            ->get();

        return $chatsRequestAll;
    }

    public static function getRequestIdFromDisplayId($displayId)
    {
        $chatRequest = ChatRequest::where('display_id', $displayId)->first();

        if ($chatRequest) {
            return $chatRequest->id;
        } else {
            return null; // throw new Exception("Chat no encontrado para el display_id proporcionado.");
        }
    }

    public static function getShowableName($requestDisplayId)
    {
        $requestId = ChatRequest::getRequestIdFromDisplayId($requestDisplayId);

        $requestData = ChatRequest::where('id', $requestId)->first();

        $otherParticipantData = Particular::getParticularData($requestData->sender_id);
        return $otherParticipantData->name . ' ' . $otherParticipantData->surname;
    }
}
