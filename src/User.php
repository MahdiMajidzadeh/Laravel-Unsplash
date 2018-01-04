<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

use GuzzleHttp\Client;

class User
{
    private $url = 'https://api.unsplash.com/';
    private $response;

    public function single($username, $params = [])
    {
        $this->execute('users/'. $username, $params);
        return $this;
    }

    public function portfolio($username)
    {
        $this->execute('users/'. $username. '/portfolio', []);
        return $this->response->url;
    }

    public function photos($username, $params = [])
    {
        $this->execute('users/'. $username. '/photos', $params);
        return $this;
    }

    public function likes($username, $params = [])
    {
        $this->execute('users/'. $username. '/likes', $params);
        return $this;
    }

    public function collections($username, $params = [])
    {
        $this->execute('users/'. $username. '/collections', $params);
        return $this;
    }

    public function statistics($username, $params = [])
    {
        $this->execute('users/'. $username. '/statistics', $params);
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
            'form_params' => $params
        ]);
        $body = (string) $response->getBody();
        $this->response = json_decode($body);
    }
}