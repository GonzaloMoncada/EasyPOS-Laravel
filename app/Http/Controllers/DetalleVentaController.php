<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Detalle_Venta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $ultimaCaja = Caja::latest('fecha')->first();
        if ($ultimaCaja) {
            $fechaCaja = $ultimaCaja->fecha;
            $diferenciaDias = Carbon::now()->diffInDays($fechaCaja);
            if ($diferenciaDias <= -1) {
                $caja = new Caja();
                $caja->fecha = Carbon::now();
                $caja->total = $ultimaCaja->total;
                $caja->movimiento = 0;
                $caja->save();
            }
        } else {
            $caja = new Caja();
            $caja->fecha = Carbon::now();
            $caja->total = 0;
            $caja->movimiento = 0;
            $caja->save();
            $ultimaCaja = $caja; 
        }

        $existingNullRow = Detalle_Venta::whereNull('id_venta')
            ->whereNull('costo_unitario')
            ->whereNull('cantidad')
            ->whereNull('id_producto')
            ->first();

        if ($existingNullRow) {
            $existingNullRow->delete();
        }
        $detalleVenta = new Detalle_Venta();
        $detalleVenta->save();
        $existingZeroCostVenta = Venta::latest()->first();
        if ($existingZeroCostVenta != null) {
            if ($existingZeroCostVenta->costo_total == 0) {
                $existingZeroCostVenta->delete();
                $venta = new Venta();
                $venta->costo_total = 0;
                $venta->fecha = Carbon::now();
                $venta->estado = true;
                $venta->save();
            } else {
                if ($existingZeroCostVenta->estado) {
                    return view('pos.punto-venta')->with('detalleVenta', $detalleVenta)->with('venta', $existingZeroCostVenta);
                } else {
                    $venta = new Venta();
                    $venta->costo_total = 0;
                    $venta->fecha = Carbon::now();
                    $venta->estado = true;
                    $venta->save();
                }
            }
        } else {
            $venta = new Venta();
            $venta->costo_total = 0;
            $venta->fecha = Carbon::now();
            $venta->estado = true;
            $venta->save();
        }


        return view('pos.punto-venta')->with('detalleVenta', $detalleVenta)->with('venta', $venta);
    }
    public function store(Request $request)
    {
        $codigo = $request->get('codigoBarras');
        $cantidad = (int)$request->get('cantidad');
        if ($cantidad == null) $cantidad = 1;
        $venta = Venta::latest()->first();
        $detalleVenta = Detalle_Venta::latest()->first();
        $caja = Caja::latest('fecha')->first();

        $producto = Producto::where('codigo', $codigo)->first();

        if ($producto) {
            $venta->costo_total += ($cantidad * $producto->precio);
            $venta->save();
            $detalleVenta->id_venta = $venta->id;
            $detalleVenta->costo_unitario = $producto->precio;
            $detalleVenta->cantidad = $cantidad;
            $detalleVenta->id_producto = $producto->id;
            $detalleVenta->save();

            return redirect()->back();
        } else {
            //ventaRealizada
            if ($codigo == null) {
                $venta->estado = false;
                $venta->save();
                foreach ($venta->detalle_venta as $detalle) {
                    $detalle->producto->stock = $detalle->producto->stock - $detalle->cantidad;
                    $detalle->producto->save();
                }
                $caja->total += $venta->costo_total;
                $caja->save();
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        }
    }
    public function destroy(string $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->back();
    }
    public function historial()
    {
        $compras = Venta::all();
        return view('history.index')->with('compras', $compras);
    }
    public function getCompras($id)
    {
        $compras = Venta::where('id', $id)->first();
        return $compras->detalle_venta()->get();
    }
    public function getDetalleProducto($id)
    {
        $detalleCompra = Detalle_Venta::where('id_venta', $id)->get();
        $arrayNames = array();
        foreach ($detalleCompra as $detalle) {
            $arrayNames[] = $detalle->producto()->first()->nombre;
        }
        return $arrayNames;
    }
    public function devolver(Request $request)
    {

        $codigo = $request->get('codigoBarras');
        $cantidad = $request->get('cantidad');
        $venta = Venta::findOrFail($request->get('ventaId'));
        /* $producto = Producto::where('codigo', $codigo)->where('cantidad',$cantidad); */
        $producto = Producto::where('codigo', $codigo)->first();
        if ($venta->detalle_venta->where('id_producto', $producto->id)
            ->where('cantidad', '>=', $cantidad)
            ->first()
        ) {
            $producto->stock += $cantidad;
            $producto->save();
            $venta->costo_total -= $producto->precio * $cantidad;
            $venta->save();
            $detallesVenta = $venta->detalle_venta->where('id_producto', $producto->id)
                ->where('cantidad', '>=', $cantidad)
                ->first();
            
            if ($detallesVenta) {
                if ($detallesVenta->cantidad <= 1) {
                    $detallesVenta->delete();
                }
                else{
                    $detallesVenta->cantidad -= $cantidad;
                    $detallesVenta->save();
                }
                return redirect()->back();
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
}
