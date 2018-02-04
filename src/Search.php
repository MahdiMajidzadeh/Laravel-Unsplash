<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Search
{
    private $url = 'https://api.unsplash.com/';
    private $response;

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
        return (array) $this->response;
    }

    public function get()
    {
        return $this->response;
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
            'query' => $params
        ]);
        $body = (string) $response->getBody();
        $this->response = json_decode($body);
    }
}
