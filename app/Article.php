<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $author
 * @property mixed $tags
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property string slug
 * @property string content
 * @property mixed $image
 */
class Article extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/blog/{$this->slug}";
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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

    public function getContentAttribute($body)
    {
        return \Purify::clean($body);
    }
}
