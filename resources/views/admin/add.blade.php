@extends('dashboard')
@section('titre')
    Ajout d'un plat
@stop

@section('contenu')
    <div>
        <div class="add" style="padding: 50px">
            <form id="newDish">
                <div>
                    <input required type="text" placeholder="Nom du plat">
                </div>
                <div class="area">
                    <textarea class="tagarea"></textarea>
                    <datalist id="ingredients">
                        @foreach($ingredients as $ingredient) <!-- Parcour d'un tableau d'ingrédients -->
                            <option value="{{ $ingredient['libelle'] }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div>
                    <input required type="text" placeholder="Prix"/>
                </div>
                <div>
                    <input required type="text" placeholder="Poids"/>
                </div>
                <div>
                    <select required>
                        @foreach($origines as $origine) <!-- Parcour d'un tableau d'origines' -->
                            <option value="{{ $origine['id'] }}">{{ $origine['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select required>
                        @foreach($types as $type) <!-- Parcour d'un tableau de types -->
                            <option value="{{ $type['id'] }}">{{ $type['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select required>
                        @foreach($typeFoods as $typeFood) <!-- Parcour d'un tableau de type de nourriture -->
                            <option value="{{ $typeFood['id'] }}">{{ $typeFood['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <button id="submit">Envoyer</button>
        </div>
    </div>
@stop
