@extends('main')

@section('content')
    <div class="card stats-card mt-5">
        <div class="card-header bg-primary">
            <div class="stats">
                <h4><b>Painel do Administrador</b> | Estatística</h4>
            </div>
        </div>
        <div class="card-body row justify-content-around">
            <div class="lines">
                <ul class="list-group">
                    <li class="list-group-item">Número de visitas gerais: <b>{{ $visitorsCount }}</b></li>
                    <li class="list-group-item">Url mais visitado: <b>{{ $mostVisitedUrl }}</b>
                        (<b>{{ $mostVisitedUrlOcurrence }}</b> vezes)</li>
                    <li class="list-group-item">Número de pesquisa de estações (Todas): <b>{{ $stationsSearch }}</b></li>
                    <li class="list-group-item">Estação mais procurada: <b>{{ $stationMostSearchedName }}</b>
                        (<b>{{ $stationMostSearchedOcurrence }}</b> vezes)
                    </li>
                    <li class="list-group-item">Número de viagens registadas: <b>{{ $registeredTrips }}</b></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
