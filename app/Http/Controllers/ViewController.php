<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\View;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;

class ViewController extends Controller
{
    public static function save($anuncio_id, $user_id, $action)
    {
        $model = new View();
        if ($user_id == null) {
            $model->user_id = mt_rand();
        } else {
            $model->user_id = $user_id;
        }
        $model->action = $action;
        $model->anuncio_id = $anuncio_id;
        $model->save();
    }
    // En tu controlador, asegurate de devolver la estructura correcta
    public function getUniqueVisits($anuncio_id, $action, $timeframe)
    {
        $query = View::where('anuncio_id', $anuncio_id)
            ->where('action', $action);

        // Ajusta el intervalo de tiempo según el valor del timeframe
        switch ($timeframe) {
            case 'day':
                $query->where('created_at', '>=', now()->subDay());
                $groupBy = 'day';
                break;
            case 'week':
                $query->where('created_at', '>=', now()->subWeek());
                $groupBy = 'week';
                break;
            case 'month':
                $query->where('created_at', '>=', now()->subMonth());
                $groupBy = 'month';
                break;
            case 'year':
                $query->where('created_at', '>=', now()->subYear());
                $groupBy = 'year';
                break;
            default:
                return response()->json([]);
        }

        $data = $query->select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as $groupBy"),
            DB::raw('count(distinct user_id) as count')
        )
            ->groupBy($groupBy)
            ->orderBy($groupBy)
            ->get();

        return response()->json($data);
    }

}
