<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'cover_image',
        'user_id'
    ];

    /**
     * Default local values for attributes
     * 
     * @var array<string, string>
     */
    protected $attributes = [
        'cover_image' => 'no_image.jpg'
    ];

    /**
     * Return the user that owns the post
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the tags presents in the post
     */
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
