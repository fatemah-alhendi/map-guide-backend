<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function get(Request $request, Response $response)
    {
        $countryData = \DB::table('country_data')->where('country', $request->get('country'))->get();
        return $response->json($countryData);
    }
}
