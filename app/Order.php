<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('count');
    }

    public function fullPriceText()
    {
        $products = $this->products;
        $totalAmount = 0;
        foreach ($products as $product) {
            $totalAmount += $product->price * $product->pivot->count;
        }
        return $totalAmount . ' руб.';
    }

    public function fullPrice()
    {
        $products = $this->products;
        $totalAmount = 0;
        foreach ($products as $product) {
            $totalAmount += $product->price * $product->pivot->count;
        }
        return $totalAmount;
    }
}
