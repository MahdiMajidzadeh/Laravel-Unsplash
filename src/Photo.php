<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Photo
{
    private $url = 'https://api.unsplash.com/';
    private $image_url = 'https://source.unsplash.com/';
    private $response;

    public function photos($params = [])
    {
        $this->execute('photos', $params);
        return $this;
    }

    public function single($id, $params = [])
    {
        $this->execute('photos/'. $id, $params);
        return $this;
    }

    public function statistic($id, $params = [])
    {
        $this->execute('photos/'. $id. '/statistics', $params);
        return $this;
    }

    public function download($id)
    {
        $this->execute('photos/'. $id. '/download', []);
        return $this->response->url;
    }

    public function curated($params = [])
    {
        $this->execute('photos/curated', $params);
        return $this;
    }

    public function random($params = [])
    {
        $this->execute('photos/random', $params);
        return $this;
    }

    public function getID()
    {
        if (count($this->response)> 1) {
            return $this->response[0]->id;
        } else {
            return $this->response->id;
        }
    }

    public function getArray()
    {
        return (array) $this->response;
    }

    public function get()
    {
        return $this->response;
    }

    public function getURL($width = 1600, $height = 900)
    {
        if (count($this->response)> 1) {
            return $this->image_url. $this->response[0]->id. '/'. $width. 'x'. $height;
        } else {
            return $this->image_url. $this->response->id. '/'. $width. 'x'. $height;
        }
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
