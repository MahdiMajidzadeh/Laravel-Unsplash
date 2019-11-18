<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

class User
{
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
}
