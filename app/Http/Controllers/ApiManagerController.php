<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ApiManagerController extends Controller
{

    private const VALID_API_KEYS = [
        'GOOGLE_MAPS_API_KEY'
    ];

    public function get(Request $request, $key)
    {
        if (!in_array($key, self::VALID_API_KEYS)) {
            return response()->json([
                'error' => 'Invalid API key'
            ], 400);
        }

        $apiKey = env($key);

        return response()->json([
            'key' => $apiKey
        ]);
    }
}
