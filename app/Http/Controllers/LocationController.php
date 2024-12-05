<?php

namespace App\Http\Controllers;

use App\Services\RwandaLocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    protected $locationService;

    public function __construct(RwandaLocationService $locationService)
    {
        $this->locationService = $locationService;
    }


    // Load form with provinces
    public function index()
    {
        $provinces = $this->locationService->fetchProvinces();


        return view('locations.index', compact('provinces'));
    }
}
