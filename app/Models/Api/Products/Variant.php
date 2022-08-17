<?php

namespace App\Models\Api\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    // public function size()
    // {
    //     return $this->belongsTo(Size::class);
    // }

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
