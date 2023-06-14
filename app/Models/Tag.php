<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Return the posts that have the tag
     */
    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
