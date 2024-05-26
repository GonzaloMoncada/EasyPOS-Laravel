@extends('padre-layout')
@section('header')
    <title>Rifa</title>
@endsection
@section('content')
    <div class="flex w-full h-screen items-center flex-col justify-center ">
        <div class="w-6/6 sm:w-5/6 lg:w-4/6 xl:w-3/6 flex bg-white rounded-t items-center pt-6 justify-center relative">
            <span class="text-4xl text-gray-700 font-bold">{{$rifa->nombre}}</span>
            <span class="absolute top-2 right-2  text-white px-2 py-1"><a href="/rifa"><img class="h-6" src="{{asset('svg/cross.svg')}}" alt=""></a></span>
        </div>

        <div
            class="w-6/6 sm:w-5/6 max-h-screen overflow-x-hidden lg:w-4/6 xl:w-3/6 grid grid-cols-10 p-6 rounded-b shadow bg-white">
            @foreach ($rifa->numero_rifa()->get() as $numero)
                <div class="flex items-center justify-center border text-gray-600">
                    <form action="/rifa/{{ $rifa->id }}/modalNumeroRifa/{{ $numero->numero }}" method="POST"> @csrf
                        <button type="submit" onclick="modalShow({{ $numero->numero }},{{ $rifa->id }})"
                            class="w-10 {{ $numero->estado == 1 && $numero->pagado == 1 ? 'bg-cyan-700 text-white opacity-90' : '' }} 
                            {{ $numero->pagado == 0 && $numero->estado == 1 ? 'bg-cyan-500 text-white' : '' }} focus:bg-gray-500 focus:opacity-50 focus:text-white h-10 flex justify-center rounded-full items-center">{{ $numero->numero }}</button>
                    </form>
                </div>
            @endforeach
        </div>
        <form id="modal" method="POST"
            action="{{ route('numeroRifa', ['id' => $rifa->id, 'numero' => $numeroData != '' ? $numeroData->numero : 0]) }}"
            {{ $hidden }} class="absolute w-3/4 xl:w-1/4  p-6 rounded bg-white shadow-2xl border ">
            @csrf
            @method('PUT')
            <a class="absolute top-4 right-4" href="/rifa/{{ $rifa->id }}"><img class="w-4 h-4"
                    src="{{ asset('svg/cross.svg') }}" alt=""></a>
            <div class=" w-full h-1/6 gap-4 mb-6 md:mb-0 flex flex-wrap flex-row">
                <div class="flex flex-col">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Titular
                    </label>
                    <input required value="@if($numeroData != ''){{ $numeroData->titular }}@endif"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="titular" name="titular" type="text" placeholder="Comprador">
                </div>
                <div class="flex flex-col">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Importe
                    </label>
                    <input required value="@if($numeroData != ''){{ $numeroData->importe }}@endif"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="importe" type="number" name="importe" placeholder="Cuanto pago del numero">
                </div>
                <div class="flex gap-2 flex-row justify-start w-full items-center">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold " for="grid-first-name">
                        Pago completo?
                    </label>
                    <input @if($numeroData != '')@if($numeroData->pagado == 1){{ 'checked' }}@endif
                        @endif
                    class=" appearance-none block w-10 bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white"
                    id="pago" name="pagado" type="checkbox" placeholder="Jane">
                </div>
                <div class="flex gap-2 flex-row justify-end w-full">
                    <button
                        class=" appearance-none block bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white"
                        id="submit" type="submit" placeholder="Jane">Guardar</button>
                </div>
            </div>
        </form>
        <div class="w-6/6 sm:w-5/6 lg:w-4/6 xl:w-3/6 flex bg-white rounded-t items-center pb-6 justify-between px-4">
            <span class="text-2xl text-gray-700 font-bold">{{ 'Pagados: '.$rifa->ocupados()->get()->where('pagado', 1)->count().'/'.$rifa->numeros}}</span>
            <form method="POST" action="{{ route('disableRifa', ['id' => $rifa->id]) }}">
                @method('PUT')
                @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-2xl text-white font-bold py-2 px-4 rounded">Terminar Rifa</button>
            </form>
            <span class="text-2xl text-gray-700 font-bold">{{ 'Numeros: '.($rifa->numeros - $rifa->libres()->count()).'/'.$rifa->numeros}}</span>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const modalShow = ($numero, id) => {
            asignarDatos($numero, id);
            var modal = document.getElementById('modal');
            modal.hidden = false;
            modal.classList.remove('animate-fade-out');
            modal.classList.add('animate-fade-in');
        }
        const modalHide = () => {
            var modal = document.getElementById('modal');
            modal.classList.remove('animate-fade-in');
            modal.classList.add('animate-fade-out');
            setTimeout(() => {
                document.getElementById('modal').hidden = true;
            }, 600);
        }
    </script>
    <script>
        const asignarDatos = (numero, id) => {

            ;
        }
    </script>
@endsection
