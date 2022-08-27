<?php

namespace App\Models\Api\Products;

use App\Models\Api\Card\Card;
use App\Models\Api\Cart\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $softDelete = true;
    protected $with = ['category'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function review()
    {
        return $this->hasMany(review::class);
    }
    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function variant()
    {
        return $this->hasMany(Variant::class);
    }


    public function cart(){
        return $this->hasMany(Cart::class);
    }
}

