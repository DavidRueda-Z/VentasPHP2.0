<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Listar cuentas del turno actual
    public function index()
    {
        $openShift = Shift::where('user_id', Auth::id())
                          ->where('status', 'open')
                          ->first();

        if (!$openShift) {
            return redirect()->route('shifts.index')
                ->with('error', 'Debes tener un turno abierto para gestionar cuentas.');
        }

        $accounts = $openShift->accounts()->get();

        return view('accounts.index', compact('accounts', 'openShift'));
    }

    // Mostrar formulario para crear cuenta
    public function create()
    {
        $openShift = Shift::where('user_id', Auth::id())
                          ->where('status', 'open')
                          ->first();

        if (!$openShift) {
            return redirect()->route('shifts.index')
                ->with('error', 'Debes tener un turno abierto para crear cuentas.');
        }

        return view('accounts.create');
    }

    // Guardar cuenta
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $openShift = Shift::where('user_id', Auth::id())
                          ->where('status', 'open')
                          ->first();

        if (!$openShift) {
            return redirect()->route('shifts.index')
                ->with('error', 'Debes tener un turno abierto.');
        }

        Account::create([
            'shift_id' => $openShift->id,
            'name'     => $request->name,
            'status'   => 'open'
        ]);

        return redirect()->route('accounts.index')
            ->with('success', 'Cuenta creada correctamente.');
    }

    // Mostrar la cuenta con sus ventas
    public function show(Account $account)
    {
        if ($account->shift->user_id !== Auth::id()) {
            return redirect()->route('accounts.index')
                ->with('error', 'Acceso denegado.');
        }

        $sales = $account->sales()->get();
        $total = $sales->sum('total_amount');

        return view('accounts.show', compact('account', 'sales', 'total'));
    }

    // Cerrar cuenta
    public function update(Request $request, Account $account)
{
    if ($account->shift->user_id !== Auth::id()) {
        return redirect()->route('accounts.index')->with('error', 'Acceso denegado.');
    }

    // CERRAR CUENTA
    $account->update(['status' => 'closed']);

    // DATOS PARA EL RECIBO
    $sales = $account->sales()->get();
    $total = $sales->sum('total_amount');

    return view('accounts.receipt', compact('account', 'sales', 'total'));
}


    // Eliminar cuenta (opcional)
    public function destroy(Account $account)
    {
        if ($account->shift->user_id !== Auth::id()) {
            return redirect()->route('accounts.index')
                ->with('error', 'Acceso denegado.');
        }

        $account->delete();

        return redirect()->route('accounts.index')
            ->with('success', 'Cuenta eliminada.');
    }
}

