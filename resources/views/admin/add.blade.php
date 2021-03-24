@extends('dashboard')
@section('titre')
    Accueil
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
                        @foreach($ingredients as $ingredient)
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
                        @foreach($origines as $origine)
                            <option value="{{ $origine['id'] }}">{{ $origine['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select required>
                        @foreach($types as $type)
                            <option value="{{ $type['id'] }}">{{ $type['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select required>
                        @foreach($typeFoods as $typeFood)
                            <option value="{{ $typeFood['id'] }}">{{ $typeFood['libelle'] }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <button id="submit">Envoyer</button>
        </div>
    </div>
@stop
