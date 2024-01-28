@extends('main')

@section('content')
    @vite(['resources/js/frequent-user.js', 'resources/scss/app.scss'])
    <div class="container">
        <div class="card">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    <h4 id="balanceText">Saldo: {{ $balance  }} €</h4>
                </div>
                <div class="add-balance col">
                    <img id="plusBalance"  data-bs-toggle="modal" data-bs-target="#balanceModal" src="{{ mix("/resources/assets/add-plus-button.png")  }}" alt="plus balance"
                         title="plus balance" width="30px">
                </div>
            </div>
        </div>
        <div class="card main-card">
            <img id="plusStations" data-bs-toggle="modal" data-bs-target="#frequentStationModal" src="{{ mix("/resources/assets/add-plus-button.png")  }}" alt="plus balance"
                 title="plus balance" width="30px">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    @foreach($frequentStations as $s)
                        <div class="">
                            <span>Estação:  {{ $s->displayName }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="station-search col">
                    <span>aaa</span>
                </div>
            </div>
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
                            <input type="number" class="form-control" id="balanceValue" minlength="0.5" >
                            <input type="hidden" id="userId" value="{{ $userId }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" style="color: white;" id="submitBalanceForm">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="frequentStationModal" tabindex="-1" aria-labelledby="frequentStationModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalStation">Fechar</button>
                    <button type="button" class="btn btn-primary" style="color: white;" id="stationAddBtn">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" style="color: #fff;">
                    <span id="toastText">Hello, world! This is a toast message.</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{ $balance  }}" id="balanceInitialValue">
@endsection
