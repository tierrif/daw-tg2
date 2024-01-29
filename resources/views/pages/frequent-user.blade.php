@extends('main')

@section('head')
    @vite(['resources/js/frequent-user.js'])
@endsection

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <div class="row balance">
                    <div class="lines col">
                        <h4 id="balanceText">Saldo: {{ $balance }} €</h4>
                    </div>
                    <div class="add-balance col">
                        <button class="btn btn-primary icon-button" id="plusBalance" data-bs-toggle="modal"
                            data-bs-target="#balanceModal">
                            <img src="{{ mix('/resources/assets/add-button.png') }}" alt="Add Balance"
                                title="Adicionar Saldo" width="15px" />
                            Adicionar Saldo
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body justify-content-around">

                <div class="button-wrapper">
                    <button class="btn btn-primary icon-button" data-bs-toggle="modal"
                        data-bs-target="#frequentStationModal">
                        <img id="plusStations" src="{{ mix('/resources/assets/add-button.png') }}" alt="Add Station"
                            title="Adicionar Estação" width="15px" />
                        Nova Estação Frequente
                    </button>
                </div>

                <div id="frequent-stations" class="station-list">
                    @foreach ($frequentStations as $s)
                        <div class="card mt-4"
                            data-station="{{ $s->stringId }}"
                            data-lines="{{ json_encode(array_map((fn($l) => $l['stringId']), $s->lines->toArray())) }}">
                            <div class="row">
                                <div class="col">
                                    <h5>Estação: {{ $s->displayName }}</h5>
                                </div>
                                <div class="col station-info">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button id="registTrip">Registar viagem</button>
        </div>
    </div>


    <div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="balanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="balanceModalLabel">Adicionar Saldo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBalanceForm">
                        <div class="mb-3">
                            <label for="balanceValue" class="col-form-label">Saldo:</label>
                            <input type="number" class="form-control" id="balanceValue" minlength="0.5">
                            <input type="hidden" id="userId" value="{{ $userId }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" style="color: white;"
                        id="submitBalanceForm">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="frequentStationModal" tabindex="-1" aria-labelledby="frequentStationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="frequentStationModalLabel">Adicionar estação</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStationForm">
                        <div class="mb-3">
                            <label for="stations" class="col-form-label">Estacão:</label>
                            <input class="form-control" list="stations" id="stationDataList"
                                placeholder="Pesquisar estação...">
                            <datalist id="stations">
                                @foreach ($allStations as $s)
                                    <option value="{{ $s['displayName'] }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="closeModalStation">Fechar</button>
                    <button type="button" class="btn btn-primary" style="color: white;"
                        id="stationAddBtn">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="stationInfoModal" tabindex="-1" aria-labelledby="stationInfoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="stationInfoModalLabel">Informações para <span id="station-name"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="stationInfoModalBody" class="modal-body">
                    <p class="text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="closeModalStation">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" style="color: #fff;">
                    <span id="toastText">Hello, world! This is a toast message.</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <input id="balanceInitialValue" type="hidden" value="{{ $balance }}" />
    <input id="frequent-stations-data" type="hidden" value="{{ json_encode($frequentStations) }}" />
@endsection
