<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(city $city)
    {
        //
    }

    public function edit(city $city)
    {
        //
    }

    public function update(Request $request, city $city)
    {
        //
    }

    public function destroy(city $city)
    {
        //
    }

    public function loadcities(Request $request)
    {
        $uf = $request->uf;

        $cities = City::where('uf', $uf)->get();
        
        return view('publications.function.cities', ['cities' => $cities]);
    }
}
