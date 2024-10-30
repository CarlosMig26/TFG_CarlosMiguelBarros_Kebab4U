<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'commentText',
        'likes',
        'restaurantReply',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'comment_user_like');
    }

    public function hasLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
