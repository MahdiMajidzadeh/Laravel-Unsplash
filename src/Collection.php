<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Collection
{
    private $url = 'https://api.unsplash.com/';
    private $response;

    public function collections($params = [])
    {
        $this->execute('collections', $params);
        return $this;
    }

    public function featured($params = [])
    {
        $this->execute('collections/featured', $params);
        return $this;
    }

    public function curated($params = [])
    {
        $this->execute('collections/curated', $params);
        return $this;
    }

    public function single($id)
    {
        $this->execute('collections/'. $id, []);
        return $this;
    }

    public function photos($id, $params)
    {
        $this->execute('collections/'. $id. '/photos', $params);
        return $this;
    }

    public function related($id)
    {
        $this->execute('collections/'. $id. '/related', []);
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
