@extends('main')

@section('content')

    <div class="card main-card">
        Estatística:
        <div class="card-body row justify-content-around">
            <div class="lines col">
                <ul>
                    <li>Número de visitas gerais: </li>
                    <li>Número de pesquisa de estações: </li>
                </ul>
            </div>
            <div class="station-search col">
                <span></span>
            </div>
        </div>
    </div>

@endsection
