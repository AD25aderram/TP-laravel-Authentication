<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        return response()->json([
            'solde' => auth('api')->user()->fresh()->solde
        ]);
    }

    public function spend(Request $request)
    {
        $request->validate([
            'montant' => 'required|integer|min:10',
        ]);

        $user = auth('api')->user()->fresh();  // ← fresh() ici aussi

        if ($request->montant > $user->solde) {
            return response()->json(['error' => 'Solde insuffisant'], 422);
        }

        $user->solde -= $request->montant;
        $user->save();

        return response()->json(['solde' => $user->solde]);
    }
}