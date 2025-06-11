<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class YoutubeService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('YOUTUBE_API_KEY');
    }

    public function getChannelVideos($channelId, $maxResults = 10)
    {
        try {
            // Obtencion de los ID de los videos más recientes del canal
            $response = $this->client->get('https://www.googleapis.com/youtube/v3/search', [
                'query' => [
                    'key' => $this->apiKey,
                    'channelId' => $channelId,
                    'part' => 'id',
                    'order' => 'date',
                    'maxResults' => $maxResults,
                    'type' => 'video'
                ]
            ]);

            $searchResults = json_decode($response->getBody(), true);

            // Extraccion de los IDs de videos
            $videoIds = [];
            foreach ($searchResults['items'] as $item) {
                $videoIds[] = $item['id']['videoId'];
            }

            // Información detallada de los videos
            $videoResponse = $this->client->get('https://www.googleapis.com/youtube/v3/videos', [
                'query' => [
                    'key' => $this->apiKey,
                    'id' => implode(',', $videoIds),
                    'part' => 'snippet,statistics,contentDetails'
                ]
            ]);

            return json_decode($videoResponse->getBody(), true);

        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
