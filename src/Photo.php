<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class Photo
{
    private $url = 'https://api.unsplash.com/';
    private $image_url = 'https://source.unsplash.com/';
    private $responce;

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
        return $this->responce->url;
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
        if(count($this->responce)> 1)
        {
            return $this->responce[0]->id;
        }
        else{
            return $this->responce->id;
        }
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
        if(count($this->responce)> 1)
        {
            return $this->image_url. $this->responce[0]->id. '/'. $width. 'x'. $height;
        }
        else{
            return $this->image_url. $this->responce->id. '/'. $width. 'x'. $height;
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
            'form_params' => $params
        ]);
        $body = (string) $response->getBody();
        $this->responce = json_decode($body);
    }
}