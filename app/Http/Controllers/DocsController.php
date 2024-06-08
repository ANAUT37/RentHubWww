<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doc;
use App\Models\User;
use App\Models\DocParticipant;
use Illuminate\Support\Facades\Auth;

class DocsController extends Controller
{
    public function index(Request $request)
    {   
        $action=null;
        if ($request->has('action')) {
            $action = $request->query('action');
        }
        return view('Docs.index', [
            'user' => $request->user(),
            'action'=>$action,
        ]);
    }
    public function create(Request $request)
    {

        if ($request->validate([
            'title' => 'required|string|max:255', // Asegura que el campo title no esté vacío y tenga un máximo de 255 caracteres
        ], [
            'title.required' => 'Debes agregar un título al documento para crearlo'
        ])) {
            $title = $request->title;

            /** @var Doc $model */
            $model = new Doc();
            $model->title = $title;
            $model->user_id = Auth::user()->id;
            $display_id = uniqid();
            $model->display_id = $display_id;

            $model->save();

            /** @var DocParticipant $participantModel */
            $participantModel = new DocParticipant();
            $participantModel->user_id = Auth::user()->id;
            $participantModel->document_id = $model->id;

            $participantModel->save();

            return redirect('/docs/'.$display_id);
        } else {
            return redirect('/docs');
        }
    }

    public function show(Request $request, $display_id)
    {
        $documentId = Doc::getIdByDisplayId($display_id);
        if (DocParticipant::isUserAbled($documentId, Auth::user()->id) === 0) {
            return redirect('/docs');
        } else {
            return view('Docs.editor')->with(
                'display_id',
                $display_id
            );
        }
    }

    public function delete(Request $request, $display_id)
    {
        $documentId = Doc::getIdByDisplayId($display_id);
        if (DocParticipant::isUserAbled($documentId, Auth::user()->id) === 0) {
            return redirect('/docs');
        } else {
            Doc::deleteByDisplayId($display_id);
            return redirect('/docs');
        }
    }
    public function saveRoles(Request $request, $display_id)
    {
        $documentId = Doc::getIdByDisplayId($display_id);
        $data = $request->all();

        if ($display_id) {
            foreach ($data as $userId => $role) {
                if ($role === 'owner') {
                    DocParticipant::where('document_id', $documentId)
                        ->where('user_id', $userId)
                        ->update(['owner' => 1, 'editable' => 1]);
                } else if ($role === 'editor') {
                    DocParticipant::where('document_id', $documentId)
                        ->where('user_id', $userId)
                        ->update(['owner' => 0, 'editable' => 1]);
                } else if ($role === 'lector') {
                    DocParticipant::where('document_id', $documentId)
                        ->where('user_id', $userId)
                        ->update(['owner' => 0, 'editable' => 0]);
                } else if ($role === 'delete') {
                    DocParticipant::where('document_id', $documentId)->where('user_id', $userId)->delete();
                }
            }
        }
    }

    public function shareRole(Request $request, $display_id)
    {
        $data = $request->validate([
            'shareEmail' => 'required|email',
            'shareRole' => 'required|in:editor,lector',
        ]);

        // Obtener el ID del usuario por correo electrónico
        $user = User::where('email', $data['shareEmail'])->first();

        if ($user) {
            $documentId = Doc::getIdByDisplayId($display_id);

            $docShare = new DocParticipant();
            $docShare->document_id = $documentId;
            $docShare->user_id = $user->id;
            $docShare->owner = 0;
            $docShare->created_at = now();
            $docShare->updated_at = now();
            $docShare->editable = ($data['shareRole'] === 'editor') ? 1 : 0;

            $docShare->save();

            return response()->json(['message' => 'Se ha compartido el documento correctamente'], 200);
        } else {
            return response()->json(['message' => 'No se ha encontrado un usuario con ese correo'], 200);
        }
    }



    public function save(Request $request, $display_id)
    {

        $content = $request->input('content');

        if ($display_id) {
            Doc::where('display_id', $display_id)
                ->update(['content' => $content]);
        }

        return response()->json(['message' => 'saved'], 200);
    }
    public static function getUserDocs()
    {
        return Doc::getAll(Auth::user()->id);
    }
    public static function getData($display_id){
        $id=Doc::getIdByDisplayId($display_id);
        $data=Doc::getById($id);

        $data=Doc::where('display_id',$display_id)->first();

        return response()->json(['data' => $data], 200);
    }
}
