<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Order;

class Product extends Model
{
    protected $guarded = [];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps()->withPivot('count');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceTextAttribute()
    {
        return $this->price . ' руб.';
    }

    public function priceForCount($count)
    {
        return $this->price * $count . ' руб.';
    }
}
