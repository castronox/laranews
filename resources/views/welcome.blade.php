<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación de noticias laranews">
    <title>{{config('app.name')}} - Portada</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>


<body class="container p-3">
    <nav>
        <ul class="nav nav-pills my-3">
            <li class="nav-item mr-2">
                <a class="nav-link active" href="{{url('/')}}">Inicio</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="{{route('articles.index')}}">Articulos</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="{{route('articles.create')}}">Nueva Noticia</a>
            </li>
        </ul>
    </nav>

<h1 class="my-2">Inicio</h1>

<main>
    <h2>Bienvenido a Laranews</h2>
    <p>Las última actualidad a tu alcance</p>

    <figure class="row mt-2 mb-2 col-10 offset-1">
        <img class="d-block w-100" alt="Portada de laranews" src="{{asset('images/laranews.png')}}">
    </figure>
</main>




<footer class="page-footer font-small p-4 bg-light">
    <p>Aplicación creada por cristian castro para su practica final</p>
</footer>
    
</body>
</html>