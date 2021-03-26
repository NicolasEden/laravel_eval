@extends('dashboard')
@section('titre')
    Panier
@stop

@section('contenu')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <div>
        <div class="home" style="padding: 50px">
            @if (count($dishes) > 0)
                <table class="mainTable">
                    <thead>
                        <tr>
                            <th class="th-title">#</th>
                            <th class="th-title">Plat</th>
                            <th class="th-title">Prix</th>
                            <th class="th-title">Poids</th>
                            <th class="th-title">Origine</th>
                            <th class="th-title">Type de nourriture</th>
                            <th class="th-title">Type du plat</th>
                            <th class="th-title">Ingrédients</th>
                            <th class="th-title"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <div>
                        @foreach ($dishes as $key=>$dishe)
                            <tr>
                                <th class="th-row">{{ $key+1 }}</th>
                                <td>{{ $dishe["libelle"] }}</td>
                                <td>{{ $dishe["price"] }}€</td>
                                <td>{{ $dishe["weight"] }}g</td>
                                <td>
                                    <p>{{ $dishe["origine"]["libelle"] }}</p>
                                </td>
                                <td>
                                    <p>{{ $dishe["type_food"]["libelle"] }}</p>
                                </td>
                                <td>
                                    <p>{{ $dishe["type"]["libelle"] }}</p>
                                </td>
                                <td>
                                    <ul class="ul-ingredient">
                                        @foreach($dishe["ingredients"] as $ingredient)
                                            <li>{{ $ingredient["libelle"] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <input type="hidden" value="{{ $dishe["id"] }}"/>
                                <td>
                                    <button class="panierDelete">Supprimer du panier</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="error">C'est vide par ici, ajoutez des produits ! </h1>
            @endif
        </div>
    </div>
@stop
