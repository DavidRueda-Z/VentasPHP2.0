<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
{
    // Verificar si hay turno abierto
    $openShift = Shift::where('user_id', Auth::id())
                      ->where('status', 'open')
                      ->first();

    if (!$openShift) {
        return redirect()->route('shifts.index')
            ->with('error', 'Debes tener un turno abierto para registrar ventas.');
    }

    // Cargar ventas de ese turno
    $sales = $openShift->sales()->latest()->get();

    // CALCULAR TOTAL DEL TURNO
    $totalTurno = $openShift->sales()->sum('total_amount');

    return view('sales.index', compact('sales', 'openShift', 'totalTurno'));
}


    public function create()
{
    $openShift = Shift::where('user_id', Auth::id())
                      ->where('status', 'open')
                      ->first();

    if (!$openShift) {
        return redirect()->route('shifts.index')
            ->with('error', 'Debes tener un turno abierto para registrar ventas.');
    }

    $products = \App\Models\Product::all();

    return view('sales.create', compact('products'));
}


    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
    ]);

    $openShift = Shift::where('user_id', Auth::id())
                      ->where('status', 'open')
                      ->first();

    if (!$openShift) {
        return redirect()->route('shifts.index')
            ->with('error', 'Debes tener un turno abierto para registrar ventas.');
    }

    $product = \App\Models\Product::find($request->product_id);

    $totalAmount = $product->price * $request->quantity;

    Sale::create([
        'shift_id'     => $openShift->id,
        'user_id'      => Auth::id(),
        'product_id'   => $product->id,
        'description'  => $product->name, // opcional
        'amount'       => $product->price,
        'quantity'     => $request->quantity,
        'total_amount' => $totalAmount,
        'sold_at'      => now(),
    ]);

    return redirect()->route('sales.index')
        ->with('success', 'Venta registrada correctamente.');
}

public function edit(Sale $sale)
{
    // Validar que pertenece al turno del usuario
    if ($sale->shift->user_id !== Auth::id()) {
        return redirect()->route('sales.index')->with('error', 'Acceso denegado.');
    }

    $products = \App\Models\Product::all();

    return view('sales.edit', compact('sale', 'products'));
}

public function update(Request $request, Sale $sale)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
    ]);

    if ($sale->shift->user_id !== Auth::id()) {
        return redirect()->route('sales.index')->with('error', 'Acceso denegado.');
    }

    $product = \App\Models\Product::find($request->product_id);
    $totalAmount = $product->price * $request->quantity;

    $sale->update([
        'product_id'   => $product->id,
        'description'  => $product->name,
        'amount'       => $product->price,
        'quantity'     => $request->quantity,
        'total_amount' => $totalAmount,
    ]);

    return redirect()->route('sales.index')->with('success', 'Venta actualizada correctamente.');
}

public function destroy(Sale $sale)
{
    if ($sale->shift->user_id !== Auth::id()) {
        return redirect()->route('sales.index')->with('error', 'Acceso denegado.');
    }

    $sale->delete();

    return redirect()->route('sales.index')->with('success', 'Venta eliminada correctamente.');
}


}

