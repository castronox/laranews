@php($pagina='listanoticias')

@extends('layouts.master')

@section('titulo', 'Lista de noticias')

@section('contenido')
    <div class="row mb-3">
        <div class="col-sm text-start">{{ $articles->links() }}</div>
        @auth
            
        <div class="col-sm text-end">
            <p>Nuevo artículo <a href="{{ route('articles.create') }}" class="btn btn-success ml-2">+</a></p>
        </div>
        
        @endauth
    </div>

    <form method="GET" class="row g-3" action="{{ route('articles.search') }}">
        <div class="col-md-4">
            <input name="titulo" type="text" class="form-control" placeholder="Título" maxlength="16" value="{{ $titulo ?? '' }}">
        </div>
        <div class="col-md-4">
            <input name="tema" type="text" class="form-control" placeholder="Tema" maxlength="16" value="{{ $tema ?? '' }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary w-100">Quitar filtro</a>
        </div>
    </form>

    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                {{-- <th>Foto</th> --}}
                <th>Título</th>
                <th>Tema</th>
                <th>Visitas</th>

                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    {{-- <td class="text-center">
                        <img class="rounded" style="max-width: 90px" 
                            src="{{ $article->imagen ? asset('storage/' . config('filesystems.articlesImageDir') . '/' . $article->imagen) : asset('storage/' . config('filesystems.articlesImageDir') . '/default.png') }}" 
                            alt="Imagen de {{ $article->titulo }} {{ $article->tema }}" 
                            title="Imagen de {{ $article->titulo }} {{ $article->tema }}">
                    </td> --}}
                    <td>{{ $article->titulo }}</td>
                    <td>{{ $article->tema }}</td>
                    <td>{{ $article->visitas }}</td>
                    
                    <td class="text-center">
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm">
                            <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}" alt="Ver detalles" title="Ver detalles">
                        </a>
                        @auth
                            @if (Auth::user()->can('update', $article))
                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                    <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}" alt="Modificar" title="Modificar">
                                </a>
                            @endif
                            @can('update', $article)
                                <a href="{{ route('articles.delete', $article->id) }}" class="btn btn-danger btn-sm">
                                    <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Eliminar" title="Eliminar">
                                </a>
                            @endcan
                        @endauth
                    </td>
                </tr>
                @if ($loop->last)
                    <tr>
                        <td colspan="7">Mostrando {{ sizeof($articles) }} de {{ $articles->total() }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <script>
        var noticias = {!! json_encode($articles) !!};
        var indice = 0;

        setInterval(function() {
            document.getElementById('info').innerHTML = noticias.data[indice].titulo + ' ' + noticias.data[indice].tema;
            indice = ++indice % noticias.data.length;
        }, 2000);
    </script>

    <p>Estas son algunas de nuestros noticias: <span id="info"></span></p>
@endsection

@section('enlaces')
@endsection
