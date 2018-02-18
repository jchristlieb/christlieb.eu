<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $articles
 */
class Tag extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
    
        self::deleting(function ($tag) {
            $tag->articles()->detach();
        });
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
