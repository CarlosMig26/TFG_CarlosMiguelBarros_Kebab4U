<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function favouritedByUsers()
    {
        return $this->belongsToMany(User::class, 'restaurant_user')->withPivot('rating')->withTimestamps();
    }
    public function averageRating()
    {
        return round($this->favouritedByUsers()->avg('rating'), 1);
    }
    protected $fillable = [
        'name', 'password', 'email', 'schedule', 'has_discount', 'phone', 'address', 'tags', 'description',
    ];

    protected $hidden = [
        'password',
    ];
}
