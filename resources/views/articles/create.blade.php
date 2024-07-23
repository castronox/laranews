@extends('layouts.master')
@section('titulo', 'Nueva noticia')


@section('contenido')

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>    
@endif

<form action="{{route('articles.store')}}" method="POST" class="my-2 border p-5">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="inputTitulo" class="col-sm-2 col-form-label">Título</label>
        <input name="titulo" type="text" class="up form-control col-sm-10" id="inputTitulo" placeholder="Título" maxlength="255" required="required" value="{{old('titulo')}}">
    </div>



    <div class="form-group row">
        <label for="inputTema" class="col-sm-2 col-form-label">Tema</label>
        <input name="tema" type="text" class="up form-control col-sm-10" id="inputTema" placeholder="Tema" maxlength="255" required="required" value="{{old('tema')}}">
    </div>

    <div class="form-group row">
        <label for="inputTexto" class="col-sm-2 col-form-label">Texto</label>
        <textarea name="texto" class="up form-control col-sm-10" id="inputTexto" placeholder="Texto" maxlength="5000" required="required">{{old('texto')}}</textarea>
    </div>

    <div class="form-group row">
        <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
        <div class="col-sm-10">
            <input name="imagen" type="file" class="form-control-file" id="inputImagen">
            <img class="rounded mt-3" style="max-width: 400px"
                src="{{ isset($article) && $article->imagen
                    ? asset('storage/' . config('filesystems.articlesImageDir') . '/' . $article->imagen)
                    : asset('storage/' . config('filesystems.articlesImageDir') . '/default.png') }}"
                alt="Imagen de {{ $article->titulo ?? 'noticia desconocida' }} {{ $article->tema ?? 'tema desconocido' }}"
                title="Imagen de {{ $article->titulo ?? 'noticia desconocida' }} {{ $article->tema ?? 'tema desconocido' }}">
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Enviar</button>
</form>




@endsection