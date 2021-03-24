@extends('dashboard')
@section('titre')
    Accueil
@stop

@section('contenu')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <div>
        <div style="padding: 50px">
            <a href="{{ route('adminAdd') }}">Ajout d'un plat</a>
        </div>
    </div>
@stop
