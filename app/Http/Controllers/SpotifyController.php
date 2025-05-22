<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\SpotifyService;

class SpotifyController extends Controller
{
    /**
     * Obtener información de un artista de Spotify por ID.
     *
     * @urlParam id string required ID del artista en Spotify. Example: 1Xyo4u8uXC1ZmMpatF05PJ
     *
     * @response 200 {
     *   "id": "1Xyo4u8uXC1ZmMpatF05PJ",
     *   "name": "The Weeknd",
     *   "genres": ["pop", "r&b"],
     *   "popularity": 96,
     *   "followers": {
     *       "total": 105271597
     *   },
     *   "images": [
     *       {
     *           "url": "https://i.scdn.co/image/ab6761610000e5eb9e528993a2820267b97f6aae",
     *           "height": 640,
     *           "width": 640
     *       }
     *   ]
     * }
     */
    public function getArtist(string $id, SpotifyService $spotifyService): JsonResponse
    {
        try {
            $artist = $spotifyService->getArtist($id);
            return response()->json($artist);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Buscar artista en Spotify por nombre.
     *
     * @urlParam name string required Nombre del artista a buscar. Example: shakira
     *
     * @response 200 {
     *   "artists": {
     *     "items": [
     *       {
     *         "id": "1Xyo4u8uXC1ZmMpatF05PJ",
     *         "name": "The Weeknd",
     *         "genres": ["pop", "r&b"]
     *       }
     *     ]
     *   }
     * }
     */
    public function searchArtist(string $name, SpotifyService $spotifyService): JsonResponse
    {
        try {
            $results = $spotifyService->searchArtist($name);
            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
