<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Storage;

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

    public function deletePhoto()
    {
        Storage::disk('public')->delete($this->image);
    }

    public function deleteProduct()
    {
        $this->deletePhoto();
        $this->delete();
    }
}
