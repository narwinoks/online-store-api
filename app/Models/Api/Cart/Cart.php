<?php

namespace App\Models\Api\Cart;

use App\Models\Api\Products\Item;
use App\Models\Api\Products\Product;
use App\Models\Api\Products\Variant;
use App\Models\Api\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='cards';

    public function variant(){
        return $this->belongsTo(Variant::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
