@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Tema</th>
                <th>Visitas</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($articles);}} --}}
            @foreach ($articles as $article)
            <tr>
                <td>#{{ $article->id }}</td>
                <td class="text-start d-flex justify-content-center">
                    <img class="rounded" style="max-width: 90px;"
                        src="{{ $article->imagen ? asset('storage/' . config('filesystems.articlesImageDir')) . '/' . $article->imagen : asset('storage/' . config('filesystems.articlesImageDir')) . '/default.png' }}"
                        alt="Imagen de {{ $article->titulo }} {{ $article->tema }}"
                        title="Imagen de {{ $article->titulo }} {{ $article->tema }}">
                </td>
                <td>{{ $article->titulo }}</td>
                <td>{{ $article->tema }}</td>
                <td>{{ $article->visitas }}</td>
                
                <td class="text-center">
                    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm">
                        <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}" alt="Ver detalles"
                            title="Ver detalles">
                    </a>
                    @auth
                    @if (Auth::user()->can('update', $article))
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">
                        <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}" alt="Modificar"
                            title="Modificar">
                    </a>
                    @endif
                    @can('update', $article)
                    <a href="{{ route('articles.delete', $article->id) }}" class="btn btn-danger btn-sm">
                        <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Eliminar"
                            title="Eliminar">
                    </a>
                    @endcan
                    @endauth
                </td>
            </tr>
            @endforeach
            @if ($articles->isEmpty())
            <tr>
                <td colspan="7">No hay noticias registradas.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
