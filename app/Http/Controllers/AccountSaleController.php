<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountSale;
use Illuminate\Http\Request;

class AccountSaleController extends Controller
{
    // Registrar venta en la cuenta
    public function store(Request $request, Account $account)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = \App\Models\Product::find($request->product_id);

        $total = $product->price * $request->quantity;

        AccountSale::create([
            'account_id'   => $account->id,
            'product_id'   => $product->id,
            'quantity'     => $request->quantity,
            'amount'       => $product->price,
            'total_amount' => $total,
            'sold_at'      => now(),
        ]);

        return redirect()->route('accounts.show', $account->id)
            ->with('success', 'Producto agregado a la cuenta.');
    }

    // Eliminar venta dentro de la cuenta
    public function destroy(AccountSale $sale)
    {
        $accountId = $sale->account_id;

        $sale->delete();

        return redirect()->route('accounts.show', $accountId)
            ->with('success', 'Venta eliminada.');
    }
}

