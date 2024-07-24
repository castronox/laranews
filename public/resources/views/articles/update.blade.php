@auth
@extends('layouts.master')

@section('tema', "Mostrar $article->tema $article->tema")

@section('contenido')

<form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{ route('articles.update', $article->id) }}">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">

    <div class="form-group row">
        <label for="inputTitulo" class="col-sm-2 col-form-label">Titulo</label>
        <div class="col-sm-10">
            <input name="tema" value="{{ $article->tema }}" type="text" class="form-control" id="inputTitulo" placeholder="Titulo" maxlength="255" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputTema" class="col-sm-2 col-form-label">Tema</label>
        <div class="col-sm-10">
            <input name="tema" value="{{ $article->tema }}" type="text" class="form-control" id="inputTema" placeholder="Tema" maxlength="255" required="required">
        </div>
    </div>
    
    <div class="form-group row">
        <label for="inputTexto" class="col-sm-2 col-form-label">Texto</label>
        <div class="col-sm-10">
            <input name="texto" value="{{ $article->texto }}" type="text" class="form-control" id="inputTexto" placeholder="Texto" maxlength="255" required="required">
        </div>
    </div>

    <div class="form-group row my-3">
        <div class="col-sm-9">
            <label for="inputImagen" class="col-form-label">
                {{ $article->imagen ? 'Sustituir' : 'Añadir' }} imagen
            </label>
            <input name="imagen" type="file" class="form-control-file" id="inputImagen">

            @if($article->imagen)
            <div class="form-check my-3">
                <input name="eliminarimagen" type="checkbox" class="form-check-input" id="inputEliminar">
                <label for="inputEliminar" class="form-check-label">Eliminar imagen</label>
            </div>
            <script>
                inputEliminar.onchange = function() {
                    inputImagen.disabled = this.checked;
                }
            </script>
            @endif
        </div>
        <div class="col-sm-3">
            <label>Imagen actual:</label>
            <img class="rounded img-thumbnail my-3" alt="Imagen de {{ $article->titulo }}" title="Imagen de {{ $article->titulo}}" src="{{ $article->imagen ? asset('storage/' . config('filesystems.articlesImageDir') . $article->imagen) : asset('storage/' . config('filesystems.articlesImageDir') . '/default.png') }}">
        </div>
    </div>





    <div class="form-group row">
        <button type="submit" class="btn btn-success mt-5 m-2">Guardar</button>
    </div>
</form>

<div class="text-end my-3">
    <div class="btn-group mx-2">
        <a class="mx-2" href="{{ route('articles.edit', $article->id) }}">
            <img height="40" width="40" src="{{ asset('images/buttons/update.png') }}" alt="Modificar" title="Modificar">
        </a>

        <a class="mx-2" href="{{ route('articles.delete', $article->id) }}">
            <img height="40" width="40" src="{{ asset('images/buttons/delete.png') }}" alt="Eliminar" title="Eliminar">
        </a>
    </div>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('articles.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection

@endauth