<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación de noticias laranews">
    <title>{{config('app.name')}}</title>


    <!-- Carga del CSS de Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="container p-3">

@section('navegacion')

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
@show

<main>
    <h1>@yield('titulo')</h1>

    @includeWhen(Session::has('success'), 'layouts.success')
    @includeWhen($errors->any(), 'layouts.error')

    @yield('contenido')

    {{-- <div class="btn-group" role="group" aria-label="Links">
        @section('enlaces')
        <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
        @show
    </div> --}}
</main>

@section('pie')
<footer class="page-footer font-small p-4 bg-light">
    <p>Aplicación creada por Cristian castro para su practica final</p>
</footer>
    @show
</body>
</html>