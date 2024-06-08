<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
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
        'answer_to',
        'type',
        'text',
        'file_type',
        'file_url',
        'created_at',
        'updated_at'
    ];
        /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'chats_messages';
}
