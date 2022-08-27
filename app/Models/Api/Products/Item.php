<?php

namespace App\Models\Api\Products;

use App\Models\Api\Cart\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
