<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'anuncio_id',
        'action',
        'created_at',
        'updated_at'
    ];

    protected $table = 'view';

    public static function getUniqueVisits($anuncio_id, $action, $period) {
        $query = self::where('anuncio_id', $anuncio_id)
                     ->where('action', $action)
                     ->select('user_id', 'created_at')
                     ->distinct('user_id');

        switch ($period) {
            case 'day':
                $query->where('created_at', '>=', Carbon::now()->subDay());
                break;
            case 'week':
                $query->where('created_at', '>=', Carbon::now()->subWeek());
                break;
            case 'month':
                $query->where('created_at', '>=', Carbon::now()->subMonth());
                break;
            case 'year':
                $query->where('created_at', '>=', Carbon::now()->subYear());
                break;
            default:
                break;
        }

        return $query->get();
    }
}
