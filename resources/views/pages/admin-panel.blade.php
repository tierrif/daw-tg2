@extends('main')

@section('content')

    <div class="card main-card">
        Estatística:
        <div class="card-body row justify-content-around">
            <div class="lines col">
                <ul>
                    <li>Número de visitas gerais: {{ $visitorsCount  }}</li>
                    <li>Url mais visitado: {{ $mostVisitedUrl  }} ({{ $mostVisitedUrlOcurrence }} vezes)</li>
                    <li>Número de pesquisa de estações (Todas): {{ $stationsSearch  }}</li>
                    <li>Estação mais procurada: {{ $stationMostSearchedName }} ({{ $stationMostSearchedOcurrence }} vezes) </li>
                    <li>Número de viagens registadas: {{ $registeredTrips  }}</li>

                </ul>
            </div>
            <div class="station-search col">
                <span></span>
            </div>
        </div>
    </div>

@endsection
