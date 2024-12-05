<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class RwandaLocationService
{
    protected $baseUrl;
    protected $headers;

    public function __construct()
    {
        $this->baseUrl = 'https://rwanda.p.rapidapi.com';
        
        $this->headers = [
            'x-rapidapi-host' => config('services.rwanda_locations.host'),
            'x-rapidapi-key' => config('services.rwanda_locations.key'),
        ];
    }

    public function fetchProvinces()
    {
        return $this->makeRequest('/provinces');
    }

    public function fetchDistricts($province)
    {
        return $this->makeRequest('/districts', ['p' => $province]);
    }

    public function fetchSectors($province, $district)
    {
        return $this->makeRequest('/sectors', ['p' => $province, 'd' => $district]);
    }

    public function fetchCells($province, $district, $sector)
    {
        return $this->makeRequest('/cells', ['p' => $province, 'd' => $district, 's' => $sector]);
    }

    public function fetchVillages($province, $district, $sector, $cell)
    {
        return $this->makeRequest('/villages', ['p' => $province, 'd' => $district, 's' => $sector, 'c' => $cell]);
    }

    private function makeRequest($endpoint, $params = [])
    {
        $response = Http::withHeaders($this->headers)->get($this->baseUrl . $endpoint, $params);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }
}
