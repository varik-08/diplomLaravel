<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Product;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function deleteProducts()
    {
        $products = Product::where('category_id', $this->id)->get();
        foreach ($products as $product)
        {
            $product->delete();
        }
    }

    public function deletePhoto()
    {
        Storage::disk('public')->delete($this->image);
    }

    public function delete()
    {
        $this->deleteProducts();
        $this->deletePhoto();
        parent::delete();
    }
}
