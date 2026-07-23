<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SavedCard;
use Illuminate\Http\Request;

class SavedCardController extends Controller
{
    public function index(Request $request)
    {
        $cards = SavedCard::where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $cards
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_type' => 'required|string|in:Visa,MasterCard,Amex,Other',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:255',
            'expiry_date' => 'required|string|max:10',
            'cvv' => 'required|string|max:10',
        ]);

        $card = SavedCard::create([
            'user_id' => $request->user()->id,
            'card_type' => $validated['card_type'],
            'card_name' => $validated['card_name'],
            'card_number' => $validated['card_number'],
            'expiry_date' => $validated['expiry_date'],
            'cvv' => $validated['cvv'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Card saved successfully',
            'data' => $card
        ], 201);
    }
}
