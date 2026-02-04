<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with(['programs', 'volunteers'])->get();
        
        return view('cities.index', compact('cities'));
    }
    
    public function show(City $city)
    {
        $city->load(['programs', 'volunteers']);
        
        return view('cities.show', compact('city'));
    }
}