<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function createCard(Request $request) {
        $request->validate([
            'question' => 'required|string',
            'awnser' => 'required|string'
        ]);
        Card::create([
            'question' => $request->question,
            'awnser' => $request->awnser
        ]);
    }

    public function getCards() {
        // Busca todos os cards no banco de dados
        $cards = Card::all();

        // Retorna os cards em formato JSON
        return response()->json($cards);
    }

    public function showCards() {
        // Busca todos os cards no banco de dados
        $cards = Card::all();

        // Retorna a view com os cards
        return view('cards', ['cards' => $cards]);
    }

}
