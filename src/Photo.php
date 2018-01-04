<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Photo
{
    private $url = 'https://api.unsplash.com/';
    private $image_url = 'https://source.unsplash.com/';
    private $responce;

    public function random($param = [])
    {
        $this->execute('photos/random', $param);
        return $this;
    }

    public function getID()
    {
        return $this->responce->id;
    }

    public function getArray()
    {
        return (array) $this->responce;
    }

    public function get()
    {
        return $this->responce;
    }

    public function getURL($width = 1600, $height = 900)
    {
        return $this->image_url. $this->responce->id. '/'. $width. 'x'. $height;
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