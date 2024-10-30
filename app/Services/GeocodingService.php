<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodingService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
    }

    public function getCoordinates(string $address): array
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => urlencode($address),
            'key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['results'])) {
                $location = $data['results'][0]['geometry']['location'];
                return ['lat' => $location['lat'], 'lng' => $location['lng']];
            }
        }

        throw new \Exception('No se han podido conseguir las coordenadas.');
    }
}
