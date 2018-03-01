<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

/**
 * @property mixed $author
 * @property mixed $tags
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property string slug
 * @property string content
 * @property mixed $image
 * @property bool $is_published
 */
class Article extends Model implements Feedable
{
    protected $guarded = [];
    
    protected $casts = [
        'is_published' => 'boolean'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('published', function ($builder) {
            $builder->where('is_published', true);
        });
    }
    public static function getFeedItems()
    {
        return Article::all();
    }
    
    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->getExcerpt(40))
            ->updated($this->updated_at)
            ->link($this->path())
            ->author($this->author->email);
    }
    
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

    public function readingTime()
    {
        return ceil(str_word_count($this->content) / 250);
    }
    
    /**
     * @param Carbon|null $dateTime
     * @return $this
     */
    public function publish(Carbon $dateTime = null)
    {
        $this->update([
            'is_published' => !$dateTime ? true : false,
            'published_at' => $dateTime ?? Carbon::now()
        ]);
        
        return $this;
    }
    
    /**
     * Get a new query builder that includes archives.
     */
    public static function withDrafts()
    {
        return (new static)->newQueryWithoutScope('published');
    }
}
