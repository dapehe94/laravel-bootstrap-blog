<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'approved',
        'parent'
    ];     

    /**
     * Return the comment's author
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the comment's post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }    

    /**
     * Scope a query to show approved comments.
     */
    public function scopeApproved($query)
    {
        $query->where('approved', 1);
    }   
}