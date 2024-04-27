<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doc;
use App\Models\DocParticipant;
use Illuminate\Support\Facades\Auth;

class DocsController extends Controller
{
    public function index()
    {
        return view('Docs.index');
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

            return redirect('/docs');
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

    public function save(Request $request, $display_id)
    {

        $content = $request->input('content');

        if ($display_id) {
            Doc::where('display_id', $display_id)
                ->update(['content' => $content]);
        }

        return response()->json(['message' => 'saved'], 200);
    }
}
