@extends('dashboard')
@section('titre')
    Edition d'un plat
@stop

@section('contenu')
    <div>
        <div class="add" style="padding: 50px">
            <form id="newDish">
                <div>
                    <input required type="text" placeholder="Nom du plat" value="{{ $dishe["libelle"] }}">
                </div>
                <div class="area">
                    <textarea class="tagarea"></textarea>
                    <ul class="tag-box">
                        @foreach($dishe["ingredients"] as $ingredient) <!-- Parcour d'un tableau d'ingrédients -->
                            <li class="tags">{{ $ingredient['libelle'] }}<a class="close"></a></li>
                        @endforeach
                    </ul>
                    <datalist id="ingredients">
                        @foreach($ingredients as $ingredient) <!-- Parcour d'un tableau d'ingrédients -->
                            <option>{{ $ingredient['libelle'] }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div>
                    <input required type="text" placeholder="Prix" value="{{ $dishe["price"] }}"/>
                </div>
                <div>
                    <input required type="text" placeholder="Poids" value="{{ $dishe["weight"] }}"/>
                </div>
                <div>
                    <select required>
                        @foreach($origines as $origine) <!-- Parcour d'un tableau d'origine -->
                            <option @if($dishe['origine']["id"] === $origine['id']) selected @endif value="{{ $origine['id'] }}">{{ $origine['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select required>
                        @foreach($types as $type) <!-- Parcour d'un tableau de types -->
                            <option @if($dishe['type']["id"] === $type['id']) selected @endif value="{{ $type['id'] }}">{{ $type['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select required>
                        @foreach($typeFoods as $typeFood) <!-- Parcour d'un tableau de types de nourriture -->
                            <option @if($dishe['type_food']["id"] === $typeFood['id']) selected @endif value="{{ $typeFood['id'] }}">{{ $typeFood['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{ $dishe["id"] }}">
            </form>
            <button id="edit">Editer</button>
        </div>
    </div>
@stop
