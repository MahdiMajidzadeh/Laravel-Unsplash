<?php
/**
 * Created by PhpStorm.
 * User: Majidzadeh
 * Date: 1/4/2018
 * Time: 11:17
 */

namespace MahdiMajidzadeh\LaravelUnsplash;


use GuzzleHttp\Client;

class Collection
{
    private $url = 'https://api.unsplash.com/';
    private $image_url = 'https://source.unsplash.com/';
    private $responce;

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