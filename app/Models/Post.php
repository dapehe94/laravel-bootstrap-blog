<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PostStatus;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'status',
        'slug',
        'user_id'
    ];    

    protected $hidden = ['pivot'];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => PostStatus::class
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => PostStatus::DRAFT
    ];

    /**
     * The model's default slug
     *
     * @var array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Return the post's author
     */
    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }    

    /**
     * Return the post categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }    

    /**
     * Return the post tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }     

    /**
     * Return the post comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }    

    /**
     * Scope a query to show publish posts.
     */
    public function scopePublish($query)
    {
        $query->where('status', 'publish');
    }     
}