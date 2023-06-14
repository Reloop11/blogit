<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'bio',
        'website',
        'social_media',
    ];

    /**
     * Default values for attributes
     * 
     * @var array<string, string>
     */
    protected $attributes = [
        'avatar' => 'no_image.png'
    ];

    /**
     * Return if the profile has any text info
     */
    public function hasInfo() {
        return (
            strlen($this->bio) > 0 ||
            strlen($this->website) > 0 ||
            strlen($this->social_media) > 0
        );
    }

    /**
     * Return the user that owns the profile
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
