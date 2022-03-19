<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

class Collection
{
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
}
