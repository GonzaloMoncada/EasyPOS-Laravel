<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rifa;
use App\Models\Producto;
use Illuminate\Support\Carbon;
use App\Models\Detalle_Rifa;
use App\Models\Numero_Rifa;
class RifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rifas = Rifa::all()->sortBy('fecha_fin')->sortByDesc('estado');
        return view('rifa.index')->with('rifas', $rifas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $productos = $productos->sortBy('nombre');
        $rifa = new Rifa();
        $rifa->estado = 0;
        return view('rifa.create')->with('rifa', $rifa)->with('productos', $productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rifa = new Rifa();
        $rifa->estado = 1;
        $rifa->nombre = $request->get('nombre');
        $numeros = $request->get('numeros');
        $rifa->numeros = $numeros;
        $fechaInicioString = $request->get('fecha-inicio');
        $rifa->fecha_inicio = Carbon::createFromFormat('D M d Y H:i:s e', $fechaInicioString);
        $fechaFinalString = $request->get('fecha-final');
        $rifa->fecha_fin = Carbon::createFromFormat('D M d Y H:i:s e', $fechaFinalString);
        $rifa->save();
        $cantidad = $request->get('cantidad-premios');
        for ($i=0; $i < $cantidad; $i++) { 
        $detalleRifa = new Detalle_Rifa();
        $detalleRifa->id_rifa = $rifa->id;
        $detalleRifa->id_producto = $request->get('premio'.$i);
        $detalleRifa->puesto = $i;
        $detalleRifa->save();
        }
        for ($i=0; $i < $numeros; $i++) { 
        $numeroRifa = new Numero_Rifa();
        $numeroRifa->id_rifa = $rifa->id;
        $numeroRifa->estado = 0;
        $numeroRifa->numero = $i;
        $numeroRifa->save();
        }
        

        return redirect('/rifa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rifa = Rifa::find($id);
        return view('rifa.details')->with('rifa', $rifa)->with('numeros', $rifa->numero_rifa()->get())->with('hidden' ,'hidden')->with('numeroData','');
    }
    public function numeroRifa (Request $request, $id, $numero){
        $numero = Numero_Rifa::where('id_rifa', $id)->where('numero', $numero)->first();
        $numero->estado = 1;
        $numero->titular = $request->get('titular');
        $numero->importe = $request->get('importe');
        $numero->pagado = $request->has('pagado');
        $numero->save();
        return redirect('/rifa/'.$id);
        
    }
    public function oneNumber($id, $numero ){
        $rifa = Rifa::find($id);
        
        return view('rifa.details')->with('rifa', $rifa)->with('numeros', $rifa->numero_rifa()->get())->with('hidden' ,'')->with('numeroData',$rifa->numero_rifa()->where('numero', $numero)->first());

    }
    public function disableRifa($id)
    {
        $rifa = Rifa::find($id);
        $rifa->estado = 0;
        $rifa->save();
        return redirect('/rifa');
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
