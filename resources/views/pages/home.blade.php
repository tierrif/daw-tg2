@extends('main')

@section('content')
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
    <div class="container">
        <h1 class="site-title h2">Planeador de Viagens para o Metropolitano de Lisboa</h1>
        <div class="card main-card">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    @foreach ($lines as $line)
                        <div class="row line {{ $line->stringId }}">
                            <div class="col">
                                <span class="line-box">Linha {{ $line->displayName }}</span>
                            </div>
                            <div class="col checkmark" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="">
                                <img src="{{ mix('resources/assets/checkmark.png') }}" width="30" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col station-search-parent">
                    <div class="station-search">
                        <label for="stationDataList" class="form-label">Verificar estado de estações</label>
                        <input class="form-control" list="datalistOptions" id="stationDataList"
                            placeholder="Pesquisar estação...">
                        <datalist id="datalistOptions">
                            @foreach ($stations as $station)
                                <option value="{{ $station->displayName }}"></option>
                            @endforeach
                        </datalist>
                        <div id="datalistError" class="invalid-feedback hidden">
                            Estação inválida. Por favor, tente novamente.
                        </div>
                        <button id="search-btn" type="button" class="btn btn-outline-primary">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="station-info" class="hidden card secondary-card bg-light">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="card-text row">
                </div>
            </div>
        </div>
    </div>

    <input id="lines" type="hidden" value="{{ json_encode($lines) }}" />
    <input id="stations" type="hidden" value="{{ json_encode($stations) }}" />
    <input id="warning_url" type="hidden" value="{{ mix('resources/assets/warning.png') }}" />
@endsection
