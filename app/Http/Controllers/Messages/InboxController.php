<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Messages\ChatRequest;
use Illuminate\Support\Str;
use App\Models\Messages\Chat;
use App\Models\Messages\ChatParticipants;

class InboxController extends Controller
{
    public function index(Request $request):View
    {
        return view('Messages.inbox', [
            'user' => $request->user(),
        ]);
    }
    public function chat(Request $request){
        return view('Messages.inbox', [
            'user' => $request->user(),
            'display_id'=>$request->display_id
        ]);
    }
    public function request(Request $request){
        return view('Messages.inbox', [
            'user' => $request->user(),
            'display_id'=>'request'
        ]);
    }
    public function chatRequest(Request $request){
        return view('Messages.inbox', [
            'user' => $request->user(),
            'display_id'=>'request',
            'request_id'=>$request->request_id
        ]);
    }
    public function chatRequestAccept(Request $request){

        $chatRequestId=ChatRequest::getRequestIdFromDisplayId($request->request_id);
        $chatRequest = ChatRequest::find($chatRequestId);

        if ($chatRequest) {
            // Guarda el campo que deseas en otra tabla
            $newChat = new Chat();
            $newChat->display_id = uniqid();
            $newChat->chat_name = $chatRequest->chat_name;
            $newChat->chat_image_url = $chatRequest->chat_image_url;
            $newChat->anuncio_id = $chatRequest->anuncio_id;
            $newChat->save();
            
            // Obtener el ID asignado automáticamente después de guardar el modelo
            $newChatId = $newChat->id;
            
            $newChatParticpantsSender= new ChatParticipants();
            $newChatParticpantsSender->user_id=$chatRequest->sender_id;
            $newChatParticpantsSender->chat_id=$newChatId;
            $newChatParticpantsSender->save(); 

            $newChatParticpantsReceiver= new ChatParticipants();
            $newChatParticpantsReceiver->user_id=$chatRequest->receiver_id;
            $newChatParticpantsReceiver->chat_id=$newChatId;
            $newChatParticpantsReceiver->save(); 
    
            // Elimina el campo de la tabla actual
            $chatRequest->delete();
    
            // Puedes devolver una respuesta apropiada
            return view('Messages.inbox', [
                'user' => $request->user(),
                'display_id'=>'request'
            ]);
        } else {
            // Si la solicitud no se encuentra, puedes devolver un mensaje de error
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

    }
    public function chatRequestDecline(Request $request){
        $chatRequestId=ChatRequest::getRequestIdFromDisplayId($request->request_id);
        $chatRequest = ChatRequest::find($chatRequestId);

        if($chatRequest){
            $chatRequest->delete();
        }
    }
}
