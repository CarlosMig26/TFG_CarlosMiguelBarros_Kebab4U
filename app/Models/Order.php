<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'order_data',
        'status',
        'deliveryman_id',
    ];
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deliveryman()
    {
        return $this->belongsTo(Deliveryman::class);
    }
}
