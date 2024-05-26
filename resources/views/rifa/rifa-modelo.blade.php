<a href="rifa/{{$rifa->id}}" class="{{$rifa->estado == 0 ? 'pointer-events-none' : ''}} {{$rifa->estado == 0 ? 'opacity-50' : ''}}">
    <div class="container font-sans group rounded shadow-lg hover:shadow-2xl bg-white border hover:border-sky-500">
        <div
            class="h-10 flex justify-center border-b  group-hover:bg-sky-600 group-hover:text-white group-hover:border-sky-500 items-center">
            <h1 class="font-bold text-center truncate ">{{ $rifa->nombre }}</h1>
        </div>
        <div
            class="h-40 flex flex-col px-4 pt-2 group-hover:text-white group-hover:bg-sky-600 text-gray-700 items-start">
            <span>Cantidad de numeros: {{ $rifa->numeros }}</span>

            <span>libres:
                @if ($rifa->libres()->count() < 4)
                    @for ($i = 0; $i < $rifa->libres()->count(); $i++)
                        @if ($i != $rifa->libres()->count() - 1)
                            {{ $rifa->libres()->get()[$i]->numero . ', ' }}
                        @else
                            {{ $rifa->libres()->get()[$i]->numero }}
                        @endif
                    @endfor
                @else
                    {{$rifa->libres()->count() }}
                @endif
            </span>
            <span>Fin de la rifa: {{ $rifa->fecha_fin }}</span>
            <span>Estado de la rifa:
                @if ($rifa->estado == 0)
                    Cerrada
                @else
                    Abierta
                @endif
            </span>
        </div>

    </div>
</a>
