<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/productos/{{$producto->id}}" method="post">
    @csrf
    @method('PUT')
    <div>
        <label for="">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="{{$producto->nombre}}">
    </div>
    <div>
        <label for="">Precio: </label>
        <input type="text" name="precio" id="precio" value="{{$producto->precio}}">
    </div>
    <div>
        <label for="">Costo: </label>
        <input type="text" name="costo" id="costo" value="{{$producto->costo}}">
    </div>
    <div>
        <label for="">Codigo: </label>
        <input type="text" name="codigo" id="codigo" value="{{$producto->codigo}}">
    </div>
    <div>
        <label for="">Stock: </label>
        <input type="text" name="stock" id="stock" value="{{$producto->stock}}">
    </div>
    <input type="submit">
    </form>
    
</body>
</html>