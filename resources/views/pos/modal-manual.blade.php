<div id="manualModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="closeManual">&times;</span>
        <form action="/punto" class="formOperar" id="ventaForm" method="POST">
            @csrf
            <input type="text" name="ventaId" id="ventaId" hidden value="{{ $venta->id }}">
            <input type="text" placeholder="Codigo de Barras" name="codigoBarras" id="codigoBarras" class="codigo inputText">
            <span>x</span>
            <input type="text" placeholder="Cantidad" name="cantidad" id="cantidad" class="cantidad inputText">
            <input type="submit" value="VENDER" class="btn-accionar">
        </form>
    </div>

</div>