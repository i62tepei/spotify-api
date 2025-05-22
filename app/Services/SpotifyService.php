<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SpotifyService
{
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->clientId = config('services.spotify.client_id');
        $this->clientSecret = config('services.spotify.client_secret');
    }

    protected function getAccessToken(): string
    {
        return Cache::remember('spotify_token', 3500, function () {
            $response = Http::asForm()->withBasicAuth($this->clientId, $this->clientSecret)
                ->post('https://accounts.spotify.com/api/token', [
                    'grant_type' => 'client_credentials',
                ]);

            if (!$response->successful()) {
                throw new \Exception('Error al obtener el token de Spotify');
            }

            return $response->json()['access_token'];
        });
    }

    public function getArtist(string $id): array
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->get("https://api.spotify.com/v1/artists/{$id}");

        if (!$response->successful()) {
            throw new \Exception('No se pudo obtener el artista desde Spotify');
        }

        return $response->json();
    }

    public function searchArtist(string $name): array
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->get('https://api.spotify.com/v1/search', [
                'q' => $name,
                'type' => 'artist',
                'limit' => 5,
            ]);

        if (!$response->successful()) {
            throw new \Exception('No se pudo buscar el artista en Spotify');
        }

        return $response->json();
    }
}
