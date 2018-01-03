<?php
/**
 * Created by PhpStorm.
 * User: Majidzadeh
 * Date: 1/3/2018
 * Time: 17:02
 */

namespace MahdiMajidzadeh\LaravelUnsplash;


use GuzzleHttp\Client;

class Photo
{
    private $url = 'https://api.unsplash.com/';
    private $responce;
    private $status;

    public function random()
    {
        return $this->execute('photos/random', []);
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
        $result = json_decode($body, true);
        return $result;
    }
}