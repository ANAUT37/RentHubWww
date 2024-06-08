<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\InmuebleController;
use App\Mail\OnChatRequestAccepted;
use App\Models\Anuncio;
use App\Models\Contract\Contract;
use App\Models\Doc;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Messages\ChatRequest;
use Illuminate\Support\Str;
use App\Models\Messages\Chat;
use App\Models\Messages\ChatParticipants;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{   

    public function createRequest(Request $request){
        $anuncio_id=$_POST['contactAnuncio'];
        $message=$_POST['contactMessage'];
        $user_id=Auth::user()->id;

        $model=new ChatRequest();
        $model->display_id=uniqid();
        $model->chat_name="";
        $model->sender_id=$user_id;
        $model->receiver_id=$_POST['contactReceiver'];
        $model->chat_image_url="";
        $model->anuncio_id=$anuncio_id;
        $model->request_text=$message;
        $model->save();
        
        return redirect()->back();
    }
    public function index(Request $request):View
    {
        return view('Messages.inbox', [
            'user' => $request->user(),
        ]);
    }
    public function chat(Request $request){
        $chatData=Chat::where('display_id',$request->display_id)->first();
        if(isset($request->display_id)&&$request->display_id!='request'){
            $contratosData=Contract::getInactiveContracts(Auth::user()->id);
            $anuncioData=Anuncio::where('id',$chatData->anuncio_id)->first();
            $inmuebleData=Inmueble::getById($anuncioData->inmueble_id);
            $imageAnuncio=InmuebleController::getInmuebleImages($inmuebleData->id);
            $otherUserId=ChatParticipants::getOtherParticipant($chatData->id,Auth::user()->id);
            
            $userDocs=Doc::getAll(Auth::user()->id);
            return view('Messages.inbox', [
                'user' => $request->user(),
                'display_id'=>$request->display_id,
                'userDocs'=>$userDocs,
                'anuncioData'=>$anuncioData,
                'inmuebleData'=>$inmuebleData,
                'listOfImages'=>$imageAnuncio,
                'contratosData'=>$contratosData,
                'otherUserId'=>$otherUserId->user_id
            ]);
        }else{
            return view('Messages.inbox', [
                'user' => $request->user(),
                'display_id'=>$request->display_id,
            ]);
        }


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

            $email = User::getDataById($chatRequest->sender_id);

            Mail::to($email)->send(new OnChatRequestAccepted($chatRequest));
    
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
