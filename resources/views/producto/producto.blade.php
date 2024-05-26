@extends('padre-layout')
@section('header')
    <title>Listado de productos</title>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
@endsection
@section('content')
    <div class="mx-auto h-full w-11/12" style="background: #bbe1fa">
        <div class="container mx-auto flex justify-center mt-10">
            <div id='recipients' class="w-11/12  p-6 sm:mt-6 mt-6 lg:mt-0 rounded shadow bg-white">
                <a href="productos/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    id="create_anco">Crear</a>
                <table id="example" class="stripe hover table-auto" style="width:100%;">
                    <thead>
                        <tr>
                            <th data-priority="1">Nombre</th>
                            <th data-priority="2">PRECIO</th>
                            <th data-priority="3">COSTO</th>
                            <th data-priority="4">CODIGO</th>
                            <th data-priority="5">STOCK</th>
                            <th data-priority="6">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr class="filabody">
                                <form action="/productos/{{ $producto->id }}" method="POST"
                                    id="form{{ $producto->id }}">
                                    @csrf
                                    @method('PUT')
                                    <td><input type="text" name="nombre" value="{{ $producto->nombre }}"
                                            id="nombre">
                                    </td>
                                    <td><input type="text" name="precio" value="{{ $producto->precio }}"
                                            id="precio">
                                    </td>
                                    <td><input type="text" name="costo" value="{{ $producto->costo }}"
                                            id="costo">
                                    </td>
                                    <td><input type="text" name="codigo" value="{{ $producto->codigo }}"
                                            id="codigo">
                                    </td>
                                    <td><input type="text" name="stock" value="{{ $producto->stock }}"
                                            id="stock"></td>
                                </form>
                                <td>
                                    @include('producto.modalConfirmation', ['id' => $producto->id])
                                    <button type="button" onclick="activateModal('{{ $producto->id }}')"
                                        class="bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-4 rounded">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type="text"]').each(function() {
                // Guardar el valor inicial del campo de texto
                $(this).data('previousValue', $(this).val());
            });
            $('input[type="text"]').on('blur', function() {
                var currentValue = $(this).val();
                var previousValue = $(this).data('previousValue');
                if (currentValue !== previousValue) {
                    var formId = $(this).closest('tr').find('form').attr('id');
                    $('#' + formId).submit();
                }
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
    return $(value).val();
};
        $(document).ready(function() {
            var table = $('#example').DataTable({
                    scrollX: true,
                    pageLength: 5,
                    scrollY: '50vh',
                    scrollCollapse: true,
                    columnDefs: [
       { "type": "html-input", "targets": [0, 1, 2, 3] }
    ] ,
                    language: {
                        paginate: {
                            previous: 'Anterior',
                            next: 'Siguiente'
                        }
                    }
                })
                
                .columns.adjust()
                .responsive.recalc();
            var exampleFilter = document.getElementById('example_filter');
            var label = exampleFilter.querySelector('label');
            // Recuperar y mantener el input
            var input = label.querySelector('input[type="search"]');
            label.textContent = 'Buscar';
            label.appendChild(input);
            var labelElement = document.createElement('label');
            var lenghtDiv = document.getElementById('example_length');
            lenghtDiv.classList.add('flex', 'h-10', 'items-center', 'ml-6');
            var crearAnco = document.getElementById('create_anco');
            lenghtDiv.removeChild(lenghtDiv.firstChild);
            lenghtDiv.appendChild(labelElement);
            lenghtDiv.classList.add('justify-center')
            labelElement.appendChild(crearAnco);

        });
    </script>

@endsection
