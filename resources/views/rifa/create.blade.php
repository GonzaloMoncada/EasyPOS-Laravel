@extends('padre-layout')
@section('header')
    <title>Rifa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
    <div class="container h-screen  mx-auto flex justify-center items-center pb-14">
        <form class="w-full max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8" action="/rifa" method="POST">
            @csrf
            <div class="w-full flex items-center justify-end "><a href="/rifa"><img src="{{ asset('svg/cross.svg') }}" alt="" class="w-3 h-4"></a></div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Nombre del sorteo
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="nombre" name="nombre" type="text" required value="Rifa">
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Cantidad de numeros
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-first-name" required name="numeros" type="number" value="100">
                </div>

            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Rango del sorteo
                    </label>
                    <input id="datepicker"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text" placeholder="Ingrese el rango" style="border:solid 1px rgb(55 65 81)">
                    <input type="hidden" name="fecha-inicio" id="fecha-inicio">
                    <input type="hidden" name="fecha-final" id="fecha-final">
                </div>

                <div class="w-1/2 md:w-1/2 px-3 flex flex-col items-end">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Cantidad de premios
                    </label>
                    <div class="w-full flex justify-end items-center gap-3">
                        <svg width="" height="50%" viewBox="0 0 1920 1920" class="w-11">
                            <g fill-rule="evenodd" clip-rule="evenodd" stroke="none" stroke-width="1">
                                <path
                                    d="M1034.59 564.21L959.198 320L885.413 562.527H640L838.898 714.104L761.906 960L960.801 808.422L1159.7 960L1081.1 715.79L1280 564.21H1034.59Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M357.542 0H1562.46V119.181H1920V542.868C1920 655.236 1875.36 763.003 1795.91 842.46C1731.12 907.242 1647.52 948.879 1557.95 962.049C1544.78 1051.62 1503.15 1135.22 1438.36 1200C1360.45 1277.91 1255.32 1322.35 1145.33 1324.05V1496.31C1145.33 1510.38 1150.91 1523.87 1160.86 1533.81C1170.81 1543.76 1184.3 1549.35 1198.36 1549.35C1263.32 1549.35 1325.61 1575.15 1371.54 1621.08C1417.47 1667.01 1443.28 1729.31 1443.28 1794.26V1920H476.723V1794.26C476.723 1729.31 502.528 1667.01 548.458 1621.08C594.388 1575.15 656.682 1549.35 721.639 1549.35C735.705 1549.35 749.195 1543.76 759.14 1533.81C769.086 1523.87 774.674 1510.38 774.674 1496.31V1324.05C664.677 1322.35 559.547 1277.91 481.637 1200C416.854 1135.22 375.218 1051.62 362.048 962.049C272.477 948.879 188.877 907.242 124.095 842.46C44.6379 763.003 0 655.236 0 542.868V119.181H357.542V0ZM489.832 132.29V900.41C489.832 977.693 520.533 1051.81 575.18 1106.46C629.828 1161.11 703.946 1191.81 781.229 1191.81H906.964V1496.31C906.964 1545.46 887.439 1592.6 852.684 1627.36C817.928 1662.11 770.79 1681.64 721.639 1681.64C691.77 1681.64 663.123 1693.5 642.001 1714.63C622.429 1734.2 610.805 1760.23 609.204 1787.71H1310.8C1309.2 1760.23 1297.57 1734.2 1278 1714.63C1256.88 1693.5 1228.23 1681.64 1198.36 1681.64C1149.21 1681.64 1102.07 1662.11 1067.32 1627.36C1032.56 1592.6 1013.04 1545.46 1013.04 1496.31V1191.81H1138.77C1216.05 1191.81 1290.17 1161.11 1344.82 1106.46C1399.47 1051.81 1430.17 977.693 1430.17 900.41V132.29H489.832ZM357.542 251.471H132.29V542.868C132.29 620.151 162.991 694.269 217.638 748.917C256.412 787.69 304.988 814.409 357.542 826.659V251.471ZM1562.46 826.659V251.471H1787.71V542.868C1787.71 620.151 1757.01 694.269 1702.36 748.917C1663.59 787.69 1615.01 814.409 1562.46 826.659Z" />
                            </g>
                        </svg>
                        <input
                            class="appearance-none block self-end w-1/3 bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="cantidad-premios" required name="cantidad-premios" type="number" value="">

                    </div>

                </div>

            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-1/2 md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Premios
                    </label>
                    <div id="contenedor-premios">
                    </div>
                    <div role="alert" id="alerta" class="hidden">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                          Error
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-2 text-red-700">
                          <p>Rellene todos los premios</p>
                        </div>
                      </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-end">
                <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" value="Crear">
            </div>

        </form>
    </div>
    {{--  --}}
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker", {
            dateFormat: "d-M-y H:i:s", //change format also 
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
            },
            mode: "range",
            onChange: function(dates) {
                if (dates.length == 2) {
                    var start = dates[0].toString().split('(')[0].trim();;
                    var end = dates[1].toString().split('(')[0].trim();;
                    var inputinicio = document.getElementById('fecha-inicio');
                    inputinicio.value = start;
                    var inputfinal = document.getElementById('fecha-final');
                    inputfinal.value = end;
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputCantidadPremios = document.getElementById("cantidad-premios");
            const contenedorPremios = document.getElementById("contenedor-premios");

            inputCantidadPremios.addEventListener("input", function() {
                const cantidad = parseInt(this.value);
                contenedorPremios.innerHTML = "";
                const form = document.querySelector('form');
                const data = document.getElementById('datepicker');
                for (let i = 0; i < cantidad; i++) {
                    contenedorPremios.innerHTML += `@include('rifa.select-prize', ['productos' => $productos])`;
                    document.getElementById("pres").name = "premio" + i;
                    document.getElementById("pres").id = "premio" + i;

                }
                for (let i = 0; i < cantidad; i++) {
                    var select = document.getElementById("premio" + i);
                    form.addEventListener('submit', function(event) {
                        if (!select.value || select.value === '0' || !data.value.length > 0) {
                            event.preventDefault(); // Evitar que el formulario se envíe
                            document.getElementById('alerta').classList.remove('hidden');
                        }
                        else{
                            document.getElementById('alerta').classList.add('hidden');
                        }
                        
                    });
                    var option = document.createElement("option");
                    option.text = (i+1) + "° Premio";
                    option.value = '0';
                    option.selected = true;
                    option.disabled = true;
                    select.appendChild(option);

                }


            });
        });
    </script>
@endsection
