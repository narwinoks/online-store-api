<?php

namespace App\Http\Controllers\Api\Card;

use App\Http\Controllers\Controller;
use App\Models\Api\Card\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
    }

    public function store(Request $request)
    {
        $data = Card::create([]);
    }
}
