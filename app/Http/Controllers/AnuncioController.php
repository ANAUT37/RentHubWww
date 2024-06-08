<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Anuncio;
use App\Models\Inmueble;
use App\Models\User;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ViewController;
use App\Models\InmuebleImage;
use App\Models\Suscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AnuncioController extends Controller
{
    public function newAnuncio()
    {
        $count = Anuncio::where('user_id', Auth::user()->id)->count();
        $suscription = Suscription::getUserData(Auth::user()->id);

        if ($suscription->subscription_type == 'particular_basic' && $count > 1) {
            return view('Account.suscriptionNeeded', [
                'user' => Auth::user(),
                'suscription'=>$suscription
            ]);
        } else {
            return view('Anuncio.new');
        }
    }
    public function index(Request $request, $anuncio_id)
    {
        $anuncio = Anuncio::getByDisplayId($anuncio_id);
        if ($anuncio != null) {
            $inmueble = Inmueble::getById($anuncio->inmueble_id);
            $inmuebleCaracteristicas = Categoria::getInmuebleCaracteristicas($anuncio->inmueble_id);
            $imageAnuncio = InmuebleController::getInmuebleImages($inmueble->id);
            $owner = User::getDataById($anuncio->user_id);
            $ownerTyped = User::getTypedData($owner->type, $owner->id);
            if (Auth::check()) {
                $isFaved = FavouriteController::isAnuncioFav($anuncio->id);
                ViewController::save($anuncio->id, Auth::user()->id, 'view');
            } else {
                $isFaved = 0;
            }

            return view('Anuncio.index', [
                'user' => $request->user(),
                'anuncio_id' => $request->anuncio_id,
                'anuncioData' => $anuncio,
                'inmuebleData' => $inmueble,
                'owner' => $owner,
                'ownerTyped' => $ownerTyped,
                'isFaved' => $isFaved,
                'listOfImages' => $imageAnuncio,
                'inmuebleCaracteristicas' => $inmuebleCaracteristicas
            ]);
        } else {
            return view('errors.404');
        }
    }
    public function statsIndex(Request $request, $anuncio_id)
    {
        $anuncio = Anuncio::getByDisplayId($anuncio_id);
        $inmueble = Inmueble::getById($anuncio->inmueble_id);
        $owner = User::getDataById($anuncio->user_id);
        $ownerTyped = User::getTypedData($owner->type, $owner->id);

        if ($anuncio->user_id === Auth::user()->id) {
            return view('Anuncio.stats', [
                'user' => $request->user(),
                'anuncio_id' => $request->anuncio_id,
                'anuncioData' => $anuncio,
                'inmuebleData' => $inmueble,
                'owner' => $owner,
                'ownerTyped' => $ownerTyped,
                'real_anuncio_id' => $anuncio->id
            ]);
        } else {
            return redirect()->back();
        }
    }
    public function edit(Request $request, $anuncio_id)
    {
        $anuncio = Anuncio::getByDisplayId($anuncio_id);
        $inmueble = Inmueble::getById($anuncio->inmueble_id);
        $owner = User::getDataById($anuncio->user_id);
        $ownerTyped = User::getTypedData($owner->type, $owner->id);

        if ($anuncio->user_id === Auth::user()->id) {
            return view('Anuncio.edit', [
                'user' => $request->user(),
                'anuncio_id' => $request->anuncio_id,
                'anuncioData' => $anuncio,
                'inmuebleData' => $inmueble,
                'owner' => $owner,
                'ownerTyped' => $ownerTyped
            ]);
        } else {
            return redirect()->back();
        }
    }
    public function categories()
    {
        $categoria = $_GET['categoria'] ?? null;
        if ($categoria) {
            $listOfCategories = Categoria::getAttributesFromCategory($categoria);
            header('Content-Type: application/json');
            echo json_encode($listOfCategories);
        } else {
            http_response_code(400);
            echo json_encode(array('error' => 'Se requiere una categoría válida en la solicitud'));
        }
    }
    public function save()
    {

        /** @var Inmueble $inmueble */
        $inmueble = new Inmueble();
        $inmueble->display_id = uniqid();
        $inmueble->latitude = $_POST['latitude'];
        $inmueble->longitude = $_POST['longitude'];
        $inmueble->address = $_POST['address'];
        $inmueble->category = $_POST['categoria'];
        $inmueble->user_id = Auth::user()->id;
        $inmueble->save();


        $listOfCategories = Categoria::getAttributesFromCategory($_POST['categoria']);

        foreach ($listOfCategories as $category) {
            if (isset($_POST[$category->key])) {
                Categoria::saveCategoriesData($category->id, $_POST[$category->key], $inmueble->id);
            }
        }

        /** @var Anuncio $anuncio */
        $anuncio = new Anuncio();
        $anuncio->display_id = uniqid();
        $anuncio->user_id = Auth::user()->id;
        $anuncio->inmueble_id = $inmueble->id;
        $anuncio->title = $_POST['title'];
        $anuncio->category = $_POST['categoria'];
        $anuncio->description = $_POST['description'];
        $anuncio->price = $_POST['price'];
        $anuncio->save();

        $num_archivos = count($_FILES);
        // Iterar sobre los archivos
        for ($i = 0; $i < $num_archivos; $i++) {
            // Obtener el nombre del archivo
            $nombre_archivo = $_FILES["img-$i"]['name'];

            // Acceder a la información del archivo
            $nombre_archivo = $_FILES["img-$i"]['name'];
            $temp_archivo = $_FILES["img-$i"]['tmp_name'];
            $error_archivo = $_FILES["img-$i"]['error'];

            $id = uniqid();

            // Verificar si el archivo temporal existe y no está vacío
            if (!empty($temp_archivo) && file_exists($temp_archivo)) {
                // Leer el contenido del archivo
                $imageContent = file_get_contents($temp_archivo);
                // Continuar con el procesamiento del archivo...

                //GUARDAR LA IMAGEN EN SERVIDOR MEDIA
                InmuebleImage::saveImage($imageContent, $id);

                $model = new InmuebleImage();
                $model->url_image = $id;
                // Puedes utilizar el número del archivo como parte de la etiqueta o en cualquier otro lugar necesario
                //$model->label = $_POST['img-' . $numero_archivo];
                $model->inmueble_id = $inmueble->id;
                //$model->size = $archivo['size'];
                //$model->file_type = $archivo['type'];
                $model->save();

                // O realizar otras operaciones, como guardar la información en la base de datos, etc.
            } else {
            }
        }

        return redirect()->to('https://renthub.es/anuncio/' . $anuncio->display_id)->with('success', 'Anuncio creado exitosamente');
    }
}
