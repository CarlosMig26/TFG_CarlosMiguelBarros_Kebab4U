<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'comment_user_like';

    protected $fillable = [
        'user_id',
        'comment_id',
    ];
}
