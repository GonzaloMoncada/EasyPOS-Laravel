@extends('padre-layout')
@section('header')
    <title>Rifa</title>
@endsection
@section('content')
    <div class="w-screen h-full p-10">
        <span class="flex w-full mb-10 items-center justify-center h-16"><a href="rifa/create" class="h-full"><img class="h-full"
                    src="{{ asset('svg/plus.svg') }}" alt=""></a></span>
        <div class="grid grid-cols-1 w-full mx-auto sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-6">
            @foreach ($rifas as $rifa)
            @include('rifa.rifa-modelo', ['rifa' => $rifa])    
            @endforeach    
        </div>
    </div>
@endsection
@section('js')
@endsection
