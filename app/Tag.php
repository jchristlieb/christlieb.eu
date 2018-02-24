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

        self::creating(function ($article) {
            $article->slug = str_slug($article->name);
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
