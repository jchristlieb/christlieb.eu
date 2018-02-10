<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function path()
    {
        return "/blog/{$this->slug}";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
