@extends('padre-layout')
@section('header')
    <title>Listado de productos</title>
@endsection
@section('content')
<div class="w-full h-full flex items-center justify-center">
<form action="/productos" method="post" class="flex p-6 rounded-xl bg-blue-400 flex-col h-full w-1/4 justify-center items-center  gap-5 mt-10" style="background-color: #0077ac">
    @csrf
    <div class="flex w-full items-center justify-end">
    <a href="/productos" class="flex items-center w-1/2 justify-center px-5 py-2 text-sm text-white transition-colors duration-200 bg-red-600 border rounded-lg sm:w-auto  hover:bg-red-500">
        <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
        </svg>
    </a>
    </div>
    <div class="flex justify-center items-center">
        <input type="text" required name="nombre" placeholder="Nombre" id="nombre">
    </div>
    <div class=" flex justify-center items-center">
        <input type="number" required placeholder="Costo" name="costo" id="costo">
    </div>
    <div class=" flex justify-center items-center">
        <input type="number" required placeholder="Precio" name="precio" id="precio">
    </div>
    <div class=" flex justify-center items-center">
        <input type="number" required placeholder="Stock" name="stock" id="stock">
    </div>
    <div class=" flex justify-center items-center">
        <input type="number" required placeholder="Codigo" name="codigo" id="codigo">
    </div>
    <input class="w-1/3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  flex justify-center items-center mt-4" type="submit" value="Enviar">
    </form>
</div>
@endsection