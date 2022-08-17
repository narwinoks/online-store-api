<?php

namespace App\Models\Api\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $huarded = [];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
