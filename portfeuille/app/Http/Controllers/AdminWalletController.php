<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminWalletController extends Controller
{
    // POST /api/admin/wallet/{user}/credit
    public function credit(Request $request, User $user)
    {
        $request->validate([
            'montant' => 'required|integer|min:1',
        ]);

        $user->solde += $request->montant;
        $user->save();

        return response()->json(['solde' => $user->solde]);
    }

    // POST /api/admin/wallet/{user}/debit
    public function debit(Request $request, User $user)
    {
        $request->validate([
            'montant' => 'required|integer|min:1',
        ]);

        if ($request->montant > $user->solde) {
            return response()->json(['error' => 'Solde insuffisant pour ce débit'], 422);
        }

        $user->solde -= $request->montant;
        $user->save();

        return response()->json(['solde' => $user->solde]);
    }
}