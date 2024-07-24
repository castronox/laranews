@extends('layouts.master')

@section('titulo', 'Inicio')


@section('contenido')
<p>La última actualidad a tu alcance</p>

<figure class="row mt-2 mb-2 col-10 offset-1">
    <img class="d-block w-100" alt="Portada de laranews" src="{{asset('images/laranews.png')}}">
</figure>
@endsection





