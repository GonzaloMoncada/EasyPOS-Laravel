@extends('padre-layout')
@section('header')
    <title>History</title>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
@endsection 
@section('content') 
<div class="w-full h-screen flex justify-center items-center ">
<div class="w-3/4 p-4 rounded-xl bg-white relative">
<div class="ml-2 absolute w-6 h-6 hover:opacity-80 z-50"><a href="{{ url()->previous() }}" class="w-full h-full"><img src="{{ asset('svg/cross.svg') }}" alt="" srcset=""></a></div>
<table id="example" class="container bg-white" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($compras as $compra)
        @if($compra->costo_total != 0)
        <tr>
            <td></td>
            <td>{{$compra->fecha}}</td>
            <td>{{$compra->costo_total}}</td>
            <td>{{$compra->id}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Id</th>
        </tr>
    </tfoot>
</table>
</div>
</div>  

@endSection
@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
    function format(d, callback) {
        $.ajax({
            url: 'historial/' + d.id,
            type: 'GET'
        })
        .done(function(response) {
            var data = response;
            var nameProducto;
            $.get('historial/producto/' + d.id, function(response) {
            var nameProducto = response;
            var html='<ul class="border-t border-b p-4">';
            for (let index = 0; index < data.length; index++) {
                html += '<li class="font-bold">Nombre: ' + nameProducto[index] + '</li>';
                html += '<li>C/u: ' + data[index].costo_unitario + '</li>';
                html += '<li >Cantidad: ' + data[index].cantidad + '</li>';
            }
            html += '</ul>';
            callback(html);
        });
        })
        .fail(function(error) {
            console.error("Error al obtener los datos:", error);
        });
    }
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "bLengthChange" : false, //thought this line could hide the LengthMenu
            "bInfo":false,
            searching: false,
            scrollY: '75vh',
            scrollCollapse: true,
            paging: false,
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { data: 'fecha' },
                { data: 'total' },
                { data: 'id' },
            ],
            order: [[3, 'desc']]
        });
        table.on('click', 'td.dt-control', function (e) {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
 
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            }
            else {
                // Open this row
                format(row.data(), function(formato) {
                    row.child(formato).show();
                });
            }
        });
    } );
    </script>
@endSection

