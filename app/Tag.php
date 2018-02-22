<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $articles
 */
class Tag extends Model
{
    protected $guarded = [];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
