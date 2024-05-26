<?php

use App\Http\Controllers\DetalleVentaController;
use Illuminate\Support\Facades\Route;
 /* Route::POST('/register', function (){
    return view("auth.register");
}); */
 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return redirect("/punto");
    });
    
    Route::get('/punto/historial', 'App\Http\Controllers\DetalleVentaController@historial')->name('punto.historial');
    Route::get('/punto/historial/{id}', 'App\Http\Controllers\DetalleVentaController@getCompras');
    Route::get('/punto/historial/producto/{id}', 'App\Http\Controllers\DetalleVentaController@getDetalleProducto');
    Route::resource('/punto', 'App\Http\Controllers\DetalleVentaController');
    Route::post('/punto/devolver', 'App\Http\Controllers\DetalleVentaController@devolver')->name('detalleventa.devolver');
    Route::resource('/productos', 'App\Http\Controllers\ProductoController');
    Route::resource('/rifa', 'App\Http\Controllers\RifaController' );
    Route::get('/caja/historial', 'App\Http\Controllers\CajaController@historial')->name('caja.historial');
    Route::resource('/caja', 'App\Http\Controllers\CajaController' );
    Route::get('/caja/historial/{id}', 'App\Http\Controllers\CajaController@getCompras');
    Route::get('/caja/historial/producto/{id}', 'App\Http\Controllers\CajaController@getDetalleProducto');
    Route::post('rifa/{id}/modalNumeroRifa/{numero}', 'App\Http\Controllers\RifaController@oneNumber')->name('modalNumeroRifa');
    Route::put('rifa/{id}/modalNumeroRifa/{numero}', 'App\Http\Controllers\RifaController@numeroRifa')->name('numeroRifa');
    Route::put('rifa/{id}/disableRifa', 'App\Http\Controllers\RifaController@disableRifa')->name('disableRifa');
    
});
