<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Obtener todos los turnos del usuario autenticado
    $shifts = Shift::where('user_id', Auth::id())
        ->orderBy('opened_at', 'desc')
        ->get();

    return view('shifts.index', compact('shifts'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('shifts.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación
    $request->validate([
        'initial_amount' => 'required|numeric|min:0',
    ]);

    // Verificar si el usuario ya tiene un turno abierto
    $existingShift = Shift::where('user_id', Auth::id())
                          ->where('status', 'open')
                          ->first();

    if ($existingShift) {
        return redirect()->route('shifts.index')
            ->with('error', 'Ya tienes un turno abierto. Ciérralo antes de iniciar otro.');
    }

    // Crear nuevo turno
    Shift::create([
        'user_id' => Auth::id(),
        'initial_amount' => $request->initial_amount,
        'status' => 'open',
        'opened_at' => now(),
    ]);

    return redirect()->route('shifts.index')
        ->with('success', 'Turno iniciado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function close(Request $request, Shift $shift)
{

    if ($shift->status !== 'open') {
        return redirect()->route('shifts.index')
            ->with('error', 'Este turno ya está cerrado.');
    }


    $request->validate([
        'final_amount' => 'required|numeric|min:0',
    ]);


    $shift->update([
        'final_amount' => $request->final_amount,
        'status' => 'closed',
        'closed_at' => now(),
    ]);

    return redirect()->route('shifts.index')
        ->with('success', 'Turno cerrado correctamente.');
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        //
    }

    public function report($id)
{
    $shift = Shift::findOrFail($id);

    if ($shift->user_id !== Auth::id() && Auth::user()->role->name !== 'admin') {
        return redirect()->route('shifts.index')
            ->with('error', 'No puedes ver detalles de este turno.');
    }

    // TOTAL DE VENTAS INDIVIDUALES
$ventas = $shift->sales()->sum('total_amount');

// TOTAL DE VENTAS POR CUENTAS
$cuentas = Account::where('shift_id', $shift->id)
    ->withSum('sales', 'total_amount')
    ->get()
    ->sum('sales_sum_total_amount');

// TOTAL DEL TURNO
$totalTurno = $ventas + $cuentas;

// CUÁNTO DEBERÍA CERRAR
$sugeridoCerrar = $shift->initial_amount + $totalTurno;


    return view('shifts.report', compact(
        'shift',
        'ventas',
        'cuentas',
        'totalTurno',
        'sugeridoCerrar'
    ));
}




public function closeView(Shift $shift)
{
    // Evitar que alguien vea un turno que no es suyo
    if ($shift->user_id !== Auth::id()) {
        return redirect()->route('shifts.index')
            ->with('error', 'No puedes ver detalles de este turno.');
    }

    // TOTAL DE VENTAS INDIVIDUALES
$ventas = $shift->sales()->sum('total_amount');

// TOTAL DE VENTAS POR CUENTAS
$cuentas = Account::where('shift_id', $shift->id)
    ->withSum('sales', 'total_amount')
    ->get()
    ->sum('sales_sum_total_amount');

// TOTAL DEL TURNO
$totalTurno = $ventas + $cuentas;

// CUÁNTO DEBERÍA CERRAR
$sugeridoCerrar = $shift->initial_amount + $totalTurno;



    return view('shifts.close-view', compact(
        'shift',
        'totalTurno',
        'sugeridoCerrar'
    ));
}


}
