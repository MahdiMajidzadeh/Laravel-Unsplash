# Laravel-Unsplash
[![StyleCI](https://styleci.io/repos/116019138/shield?branch=master)](https://styleci.io/repos/116019138)

**This package contain pulic actions**

## Install

Via Composer

``` bash
$ composer require mahdimajidzadeh/laravel-unsplash
```
If you do not run Laravel 5.5 (or higher), then add the service provider in config/app.php:

```
MahdiMajidzadeh\LaravelUnsplash\LaravelUnsplashServiceProvider::class
```

If you do run the package on Laravel 5.5+, package auto-discovery takes care of the magic of adding the service provider.

You must publish the configuration to provide an own service provider stub.

``` bash
$ php artisan vendor:publish --provider="MahdiMajidzadeh\LaravelUnsplash\LaravelUnsplashServiceProvider"
```

## Usage
See documention for params and others at [unsplash docs](https://unsplash.com/documentation)

List of methods: 

### Photos

``` php
$unsplash  = new MahdiMajidzadeh\LaravelUnsplash\Photo();
$photos    = $unsplash->photos($params)->get();          // list of all photos
$photo     = $unsplash->single($id, $params)->get();     // single photo
$statistic = $unsplash->statistic($id, $params)->get();  // single photo statistics
$link      = $unsplash->download($id);                   // single photo download link
$photos    = $unsplash->curated($params)->get();         // list of curated photos
$photo     = $unsplash->random($params)->get();          // random photo
```

**notice**: you can use `getArray()` instead of `get()` to get array of result.

**notice**: `single($id, $params)` and `random($params)` have `getID()` and `getURL()` methods to get ID and URL for using in `<img>` tag.
``` php
$photos = $unsplash->random($params)->getURL(); // return https://source.unsplash.com/WLUHO9A_xik/1600x900
```

### Users

``` php
$unsplash     = new MahdiMajidzadeh\LaravelUnsplash\User();
$user         = $unsplash->single($username, $params)->get();       // single user
$portfolio    = $unsplash->portfolio($username);                    // single user's portfolio
$photos       = $unsplash->photos($username, $params)->get();       // single user's photos
$photos       = $unsplash->likes($username, $params)->get();        // single user's likes
$collections  = $unsplash->collections($username, $params)->get();  // single user's collections
$statistics   = $unsplash->statistics($username, $params)->get();   // single user's statistics
```

**notice**: you can use `getArray()` instead of `get()` to get array of result.

### Collections

``` php
$unsplash    = new MahdiMajidzadeh\LaravelUnsplash\Collection();
$collection  = $unsplash->collections($params)->get(); // list of all collections
$collection  = $unsplash->single($id)->get(); // single collections
$photos      = $unsplash->photos($id, $params)->get(); // collection photos
$statistic   = $unsplash->statistic($id, $params)->get(); // single collections statistics
$collection  = $unsplash->curated($params)->get(); // list of curated collections
$collection  = $unsplash->related($id)->get(); // list of related collections
$collection  = $unsplash->featured($params)->get(); // list of featured collections
```

**notice**: you can use `getArray()` instead of `get()` to get array of result.

### Search

``` php
$unsplash   = new MahdiMajidzadeh\LaravelUnsplash\Search();
$photos     = $unsplash->photo($query, $params)->get();
$collection = $unsplash->collection($query, $params)->get();
$user       = $unsplash->user($query, $params)->get();
```
**notice**: you can use `getArray()` instead of `get()` to get array of result.
