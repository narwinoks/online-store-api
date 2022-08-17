<?php

namespace App\Models\Api\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function variant()
    {
        return $this->hasMany(Variant::class);
    }
}
