<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Search
{
    private $url = 'https://api.unsplash.com/';
    private $image_url = 'https://source.unsplash.com/';
    private $responce;

    public function photo($query, $params = [])
    {
        $params['query'] = $query;
        $this->execute('search/photos', $params);
        return $this;
    }

    public function collection($query, $params = [])
    {
        $params['query'] = $query;
        $this->execute('search/collections', $params);
        return $this;
    }

    public function user($query, $params = [])
    {
        $params['query'] = $query;
        $this->execute('search/users', $params);
        return $this;
    }

    public function getArray()
    {
        return (array) $this->responce;
    }

    public function get()
    {
        return $this->responce;
    }

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
            'form_params' => $params
        ]);
        $body = (string) $response->getBody();
        $this->responce = json_decode($body);
    }
}