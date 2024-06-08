<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'key',
        'display_name',
        'description',
        'icon_url',
        'created_at',
        'updated_at',
        'category'
    ];

    protected $table = 'inmueble_attributes';

    public static function getAttributesFromCategory($category)
    {
        $listOfCategories = Categoria::where('category', $category)->get();
        return $listOfCategories;
    }
    public static function saveCategoriesData($key, $value, $inmueble_id)
    {
        DB::table('inmueble_attributes_values')->insert([
            'attribute_id' => $key,
            'value' => $value,
            'inmueble_id' => $inmueble_id
        ]);
    }

    public static function getInmuebleCaracteristicas($inmueble_id)
    {
        $inmuebleAttributes = DB::table('inmueble_attributes_values')
            ->where('inmueble_id', $inmueble_id)
            ->get();

        $data = [];
        foreach ($inmuebleAttributes as $item) {
            $attributeData = Categoria::where('id', $item->attribute_id)->first();

            if ($attributeData) {
                $model = [
                    'key' => $attributeData->key,
                    'value' => $item->value,
                    'label' => $attributeData->display_name,
                    'icon' => $attributeData->icon_url
                ];
                $data[] = $model;
            }
        }
        return $data;
    }
}
