@extends('main')

@section('head')
    @vite(['resources/js/frequent-user.js'])
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    <h4>Saldo: {{ $balance }} €</h4>
                </div>
                <div class="add-balance col">
                    <img id="plusBalance"  data-bs-toggle="modal" data-bs-target="#balanceModal" src="{{ mix('/resources/assets/add-plus-button.png') }}" alt="plus balance"
                        title="plus balance" width="30px">
                </div>
            </div>
        </div>
        <div class="card main-card">
            <img id="plusStations" data-bs-toggle="modal" data-bs-target="#frequentStationModal" src="{{ mix('/resources/assets/add-plus-button.png') }}" alt="plus balance"
                title="plus balance" width="30px">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    @foreach ($stations as $s)
                        <div class="">
                            <span>Estação: {{ $s->displayName }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="station-search col">
                    <span>aaa</span>
                </div>
            </div>
        </div>

        <button style="position:fixed;
            right:0;
            bottom:0;">
            <img id="plusBalance" src="{{ mix('/resources/assets/add-plus-button.png') }}" alt="plus balance"
                title="plus balance" width="30px">
        </button>
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
                            <input type="text" class="form-control" id="balanceValue">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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
                            <label for="station" class="col-form-label">Estacão:</label>
                            <input type="text" class="form-control" id="station">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" style="color: white;">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
