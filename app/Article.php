<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $author
 */
class Article extends Model
{
    
    protected $guarded = [];
    
    public function path()
    {
        return "/blog/{$this->slug}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getExcerpt($count = 50)
    {
        preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $this->content, $matches);

        return $matches[0].'...';
    }
}
