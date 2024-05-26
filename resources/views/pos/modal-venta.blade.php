<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>

        <form action="{{ route('detalleventa.devolver') }}" class="formOperar" id="ventaForm" method="POST">
            @csrf
            <input type="text" name="ventaId" id="ventaId" hidden value="{{ $venta->id }}">
            <input type="text" name="codigoBarras" id="codigoBarras" class="codigo inputText">
            <span>x</span>
            <input type="text" name="cantidad" id="cantidad" class="cantidad inputText">
            <input type="submit" value="VENDER" class="btn-accionar">
        </form>
    </div>

</div>