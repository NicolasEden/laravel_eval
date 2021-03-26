@extends('dashboard')
@section('titre')
    Accueil Admin
@stop

@section('contenu')
    <div>
        <div class="admin-home" style="padding: 50px">
            <a href="{{ route('adminAdd') }}">Ajout d'un plat</a>
            <a href="{{ route('adminShow') }}">Modification/suppression d'un plat</a>
        </div>
    </div>
@stop
