@extends('padre-layout')
@section('header')
    <title>Caja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
    <form action="/caja" method="POST" class="h-screen w-full flex items-center justify-center flex-col">
        @csrf
        <div class="bg-white rounded-t rounded-l shadow-md w-1/3 p-6" >
            <div class="w-full flex-wrap flex items-center relative">
                <div class="flex items-start absolute h-8  top-0 left-2">
                    <a class="w-full h-full " href="/caja/historial"><img src="{{ asset('svg/history.svg') }}" alt="" class="w-full h-full hover:opacity-80" srcset=""></a>
                </div>
                <div class="flex items-end md:flex-col  w-full ">
                    <div class="md:w-2/3 w-full flex flex-col  items-start md:items-end" id="alert">
                        <label class="w-3/4" for="date">Fecha de la compra</label>
                        <input id="datepicker"
                            class="appearance-none block w-3/4 bg-gray-200 border-gray-400 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="text" name="date" placeholder="Fecha">
                    </div>
                </div>
                <div class="flex flex-col items-start md:w-1/2 w-full">
                    <label for="cantidad" class="w-1/2">Cant.</label>
                    <input type="number" value="0" required min="0" name="cantidad" id="cantidad"
                        class="appearance-none block w-1/2 bg-gray-200 border-gray-400 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
            </div>
            <div class="hidden md:flex flex-row w-full gap-2 mt-2 overflow-auto p-2">
                <div class="w-1/3 text-center">Producto</div>
                <div class="w-1/4 text-center">Unidades</div>
                <div class="w-1/3 text-center">Precio</div>
            </div>
            <div class="flex flex-col mt-2 md:mt-0 w-full overflow-auto border rounded p-2" id="contenedor" style="max-height: 20vh; height: 20vh">
            </div>
            <div class="flex flex-row w-full mt-6">
                Total:<span id="total"> </span>
            </div>
            <input type="number" name="total" value="" id="totalInput" hidden>
        </div>
        <div class="w-1/3 flex justify-end">
            <div class="w-1/3 flex items-center justify-center rounded-b py-2 bg-white">
                <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mb-2 rounded cursor-pointer" value="Enviar">
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker", {
            dateFormat: "d-M-y",
            altInput: true,
            altFormat: 'd-m-Y',
            locale: {
                rangeSeparator: ' - ',
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                },
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputCantidad = document.getElementById("cantidad");
            const contenedor = document.getElementById("contenedor");

            inputCantidad.addEventListener("input", function() {
                const cantidad = parseInt(this.value);
                contenedor.innerHTML = "";
                const form = document.querySelector('form');
                const data = document.getElementById('datepicker');
                
                for (let i = 0; i < cantidad; i++) {
                    var divProducto = document.createElement("div");
                    var divPadre = document.createElement("div");
                    var divCantidad = document.createElement("div");
                    var divPrecio = document.createElement("div");
                    divPadre.classList.add("flex", "flex-row", "mb-6" , "gap-2" ,"w-full", "flex-wrap");
                    divProducto.classList.add("flex", "flex-col", "w-full", "md:w-1/3");
                    divCantidad.classList.add("flex", "flex-col", "w-full", "md:w-1/4");
                    divPrecio.classList.add("flex", "flex-col", "w-full", "md:w-1/3");
                    divProducto.innerHTML += `@include('caja.select-prize', ['productos' => $productos])`;
                    divCantidad.innerHTML += `@include('caja.select-amount')`;
                    divPrecio.innerHTML += `@include('caja.select-price')`;
                    contenedor.appendChild(divPadre);
                    divPadre.appendChild(divProducto);
                    divPadre.appendChild(divCantidad);
                    divPadre.appendChild(divPrecio);
                    document.getElementById("pres").name = "producto" + i;
                    document.getElementById("pres").id = "producto" + i;
                    document.getElementById("amount").name = "monto" + i;
                    document.getElementById("amount").id = "monto" + i;
                    document.getElementById("price").name = "precio" + i;
                    document.getElementById("price").id = "precio" + i;


                }
                for (let i = 0; i < cantidad; i++) {
                    var select = document.getElementById("producto" + i);
                    form.addEventListener('submit', function(event) {
                        if (!select.value || select.value === '0' || !data.value.length > 0) {
                            event.preventDefault(); // Evitar que el formulario se envíe
                            document.getElementById('alert').getElementsByTagName('input')[1].classList.remove('border-gray-400');
                            document.getElementById('alert').getElementsByTagName('input')[1].classList.add('border-red-500');
                        } else {
                            document.getElementById('alert').getElementsByTagName('input')[1].classList.remove('border-red-500');
                            document.getElementById('alert').getElementsByTagName('input')[1].classList.add('border-gray-400');

                        }

                    });
                    var option = document.createElement("option");
                }


            });
        });
    </script>
    <script>
        const calcularTotal = () => {
            const inputCantidad = document.getElementById("cantidad").value;
            var total = 0;
            for (let i = 0; i < inputCantidad ; i++) {
                var precio = document.getElementById("precio" + i).value;
                var cantidad = document.getElementById("monto" + i).value;
                if(precio>0 && cantidad>0){
                    total = total + (parseFloat(precio) * parseFloat(cantidad));
                }
                document.getElementById("total").innerHTML = total.toFixed(2);
                document.getElementById("totalInput").value = total.toFixed(2);
            }
        }
    </script>
@endSection
