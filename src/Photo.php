<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

class Photo extends Unsplush
{
    private $image_url = 'https://source.unsplash.com/';

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

    public function getURL($width = 1600, $height = 900)
    {
        $count = is_array($this->response) ? count($this->response) : 1;
        if ($count > 1) {
            return $this->image_url. $this->response[0]->id. '/'. $width. 'x'. $height;
        } else {
            return $this->image_url. $this->response->id. '/'. $width. 'x'. $height;
        }
    }
}
