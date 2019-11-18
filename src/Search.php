<?php

namespace MahdiMajidzadeh\LaravelUnsplash;

class Search
{
    public function photo($query, $params = [])
    {
        $params['query'] = $query;
        $this->execute('search/photos', $params);
        return $this;
    }

    public function collection($query, $params = [])
    {
        $params['query'] = $query;
        $this->execute('search/collections', $params);
        return $this;
    }

    public function user($query, $params = [])
    {
        $params['query'] = $query;
        $this->execute('search/users', $params);
        return $this;
    }
}
