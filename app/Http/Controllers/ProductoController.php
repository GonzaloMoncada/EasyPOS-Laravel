<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('producto.producto')->with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producto.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->get('nombre');
        $producto->precio = $request->get('precio');
        $producto->costo = $request->get('costo');
        $producto->codigo = $request->get('codigo');
        $producto->stock = $request->get('stock');
        $producto->save();
        return redirect('/productos');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return view("producto.editar")->with('producto',$producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $request->get('nombre');
        $producto->precio = $request->get('precio');
        $producto->costo = $request->get('costo');
        $producto->codigo = $request->get('codigo');        
        $producto->stock = $request->get('stock');
        $producto->save();
        return redirect('/productos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect('/productos');
    }
}
