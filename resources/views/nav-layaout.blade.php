<nav class="nav">
    <div class="div-logo">
        <img src="{{ asset('svg/logo.jpg') }}" alt="">
        <span class="text-center">Team Moncada</span>
    </div>
    <div class="div-nav">
        <a href='/punto' class="hiddenMobile"><img id="svgPunto" class="hiddenMobile" src="{{ asset('svg/punto.svg') }}" alt=""
                srcset=""></a>
        <a href='/productos' class=""><img id="svgProducto" src="{{ asset('svg/products.svg') }}" alt=""
                srcset=""></a>
        <a href='/rifa' class="rifa"><img id="svgRifa" src="{{ asset('svg/roulette.svg') }}" alt=""
                srcset=""></a>
        <a href="/caja" class="caja"><img id="svgCaja" src="{{ asset('svg/cash-register.svg') }}" alt=""
                srcset=""></a>
    </div>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener la ruta actual
        var tituloActual = document.title;
        function prevenirEvento(event) {
    event.preventDefault();
}
        // Comprobar si la ruta actual coincide con una determinada página
        switch (tituloActual) {
            case 'Punto de venta':
                document.getElementById("svgPunto").style.filter = 'invert(100%)';
                document.getElementById("svgPunto").style.opacity = "1";
                document.getElementById("svgPunto").style.cursor = "default";
                document.getElementById("svgPunto").parentNode.removeAttribute('href');
                document.getElementById("svgPunto").parentNode.addEventListener('click', prevenirEvento);

                break;

            case 'Listado de productos':
                document.getElementById("svgProducto").style.filter = 'invert(100%)';
                document.getElementById("svgProducto").style.opacity = "1";
                document.getElementById("svgProducto").style.cursor = "default";
                document.getElementById("svgProducto").parentNode.removeAttribute('href');
                document.getElementById("svgProducto").parentNode.addEventListener('click', prevenirEvento);
                break;

            case 'Rifa':
                document.getElementById("svgRifa").style.filter = 'invert(100%)';
                document.getElementById("svgRifa").style.opacity = "1";
                document.getElementById("svgRifa").style.cursor = "default";
                document.getElementById("svgRifa").parentNode.removeAttribute('href');
                document.getElementById("svgRifa").parentNode.addEventListener('click', prevenirEvento);
                break;

            case 'Caja':
                document.getElementById("svgCaja").style.filter = 'invert(100%)';
                document.getElementById("svgCaja").style.opacity = "1";
                document.getElementById("svgCaja").style.cursor = "default";
                document.getElementById("svgCaja").parentNode.removeAttribute('href');
                document.getElementById("svgCaja").parentNode.addEventListener('click', prevenirEvento);
                break;

            default:
                break;

        }
    });
</script>
