<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Carbon\Carbon;
use App\Models\Compra;
use App\Models\Detalle_Compra;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('caja.index')->with('productos', $productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $compra = new Compra();
        $compra->fecha = Carbon::createFromFormat('d-M-y', $request->get('date'));
        $compra->costo_total = $request->get('total');
        $compra->save();
        for ($i = 0; $i < $request->get('cantidad'); $i++) {
            $detalleCompra = new Detalle_Compra();
            $detalleCompra->id_compra = $compra->id;
            $detalleCompra->costo_unitario = $request->get('precio'.$i);
            $detalleCompra->cantidad = $request->get('monto'.$i);
            $detalleCompra->id_producto = $request->get('producto'.$i);
            $producto = $detalleCompra->producto()->first();
            $producto->stock += $request->get('monto'.$i);
            $producto->costo = $request->get('precio'.$i);
            $producto->save();
            $detalleCompra->save();
        }

        return redirect('/caja');
    }

    /**
     * Display the specified resource.
     */
    public function historial()
    {
        $compras = Compra::all();
        return view('history.index')->with('compras', $compras);
    }
    public function getCompras($id)
    {
        $compras = Compra::where('id', $id)->first();
        return $compras->detalle_compra()->get();
    }
    public function getDetalleProducto($id)
    {
        $detalleCompra = Detalle_Compra::where('id_compra', $id)->get();
        $arrayNames = array();
        foreach ($detalleCompra as $detalle) {
            $arrayNames[] = $detalle->producto()->first()->nombre;
        }
        return $arrayNames;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
