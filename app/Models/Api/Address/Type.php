<?php

namespace App\Models\Api\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
