@extends('layouts.master')
@section('titulo', 'Nueva noticia')

@section('contenido')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="display-4">{{ $article->titulo }}</h2>
                <p class="text-muted">Tema: {{ $article->tema }}</p>
                <p class="text-muted">Escrito por: {{ $article->user ? $article->user->name : 'Sin redactor' }}</p>
                <p class="text-muted">Visitas: {{ $article->visitas }}</p>

                <div class="article-details mt-4">
                    <p><strong>ID del Artículo:</strong> {{ $article->id }}</p>
                    <p><strong>Matriculada:</strong> {{ $article->matriculada ? 'Sí' : 'No' }}</p>

                    @if ($article->matriculada)
                        <p><strong>Matrícula:</strong> {{ $article->matricula }}</p>
                    @endif

                    @if ($article->color)
                        <p><strong>Color:</strong> <span
                                style="background-color: {{ $article->color }}; padding: 0 5px; color: #fff;">{{ $article->color }}</span>
                        </p>
                    @endif
                </div>

                <div class="article-image mt-4">
                    <img class="img-fluid rounded" style="max-width: 100%;"
                        src="{{ $article->imagen ? asset('storage/' . config('filesystems.articlesImageDir') . '/' . $article->imagen) : asset('storage/' . config('filesystems.articlesImageDir') . '/default.png') }}"
                        alt="Imagen de {{ $article->titulo }} {{ $article->tema }}"
                        title="Imagen de {{ $article->titulo }} {{ $article->tema }}">
                </div>

                <div class="article-text mt-4">
                    <p>{{ $article->texto }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
