@extends('padre-layout')
@section('header')
<title>Punto de venta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/venta.css') }}">
@endsection
@section('modal')
    @include('pos.modal-venta')
    @include('pos.modal-manual')
@endsection
@section('content')
<div class="contenido">
    <div class="titulo">
        <span>Venta</span>
        <span><a href="{{ route('punto.historial') }}"><img src="{{ asset('svg/history.svg') }}" alt=""></a></span>
    </div>
    <div class="tabla">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <div class="divAbsolute">
                    <form action="{{ route('punto.destroy', $venta->id) }}" method="POST" class="destroy">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttonAbsolute"><img src="{{ asset('svg/back.svg') }}" alt=""></button>
                    </form>
                    </div>
                </tr>
            </thead>
            <tbody>
                @if ($venta->detalle_venta != null)
                    @if (count($venta->detalle_venta) > 9)
                        @foreach ($venta->detalle_venta as $detalle)
                            <tr>
                                <td><span>{{ $detalle->producto->nombre }}</span></td>
                                <td><span>{{ $detalle->cantidad . 'x' . $detalle->costo_unitario }}</span></td>
                                <td><span>{{ $detalle->producto->stock }}</span></td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($venta->detalle_venta as $detalle)
                            <tr>
                                <td><span>{{ $detalle->producto->nombre }}</span></td>
                                <td><span>{{ $detalle->cantidad . 'x' . $detalle->costo_unitario }}</span></td>
                                <td><span>{{ $detalle->producto->stock }}</span></td>
                            </tr>
                        @endforeach
                        @for ($i = 0; $i < 10 - (count($venta->detalle_venta)); $i++)
                        <tr>
                        <td><span></span></td>
                        <td><span></span></td>
                        <td><span></span></td>
                        </tr>
                        @endfor
                    @endif
                @else
                    <tr>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="info">
        <div class="contenedorInfo">
            <div class="accionar">
                <form action="/punto" class="formOperar" method="POST" id="ventaForm">
                    @csrf
                    <input type="text" name="ventaId" id="ventaId" hidden value="{{ $venta->id }}">
                    <input type="text" name="codigoBarras" id="codigoBarras" class="codigo inputText"
                        autofocus>
                    <span>x</span>
                    <input type="text" name="cantidad" id="cantidad" class="cantidad inputText">
                    <input type="submit" value="VENDER" class="btn-accionar">
                </form>
                <div class="formDevolver">
                    <input type="submit" value="REGRESAR" class="btn-accionar" id="myBtn">
                </div>
                <div class="formDevolver">
                    <button type="submit" class="btn-accionar" id="myBtnManual">
                        Introduccir
                    </button>
                </div>
            </div>
            <div class="totalDiv">
                <div class="TOTAL">
                    <span>TOTAL: {{$venta->costo_total}}</span>
                </div>
                <div class="subrayado"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var modal = document.getElementById("myModal");

    var btn = document.getElementById("myBtn");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>
    var modalManual = document.getElementById("manualModal");

    var btnManual = document.getElementById("myBtnManual");

    var spanManual = document.getElementById("closeManual");

    btnManual.onclick = function() {
        modalManual.style.display = "block";
    }

    spanManual.onclick = function() {
        modalManual.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modalManual.style.display = "none";
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#codigoBarras').on('input', function() {
            if ($(this).val().length ===
                13) { // Suponiendo que los códigos de barras tienen 13 caracteres
                $('#ventaForm')
            .submit(); // Envía el formulario cuando se completa la entrada del código de barras
            }
        });
    });
</script>
@endsection