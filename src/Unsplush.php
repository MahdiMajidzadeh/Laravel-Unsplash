<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Unsplush
{
    private $url = 'https://api.unsplash.com/';
    private $response;

    private function execute($url, $params)
    {
        $client = new Client([
            'base_uri' => $this->url,
        ]);
        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept-Version' => 'v1',
                'Authorization'  => 'Client-ID '. config('unsplash.ApplicationID')
            ],
            'query' => $params
        ]);
        $body = (string) $response->getBody();
        $this->response = json_decode($body);
    }

    public function getArray()
    {
        return (array) $this->response;
    }

    public function get()
    {
        return $this->response;
    }
}
