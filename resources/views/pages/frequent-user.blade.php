@extends('main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    <h4>Saldo: {{ $balance  }} €</h4>
                </div>
                <div class="add-balance col">
                    <img id="plusBalance" src="{{ mix("/resources/assets/add-plus-button.png")  }}" alt="plus balance"
                         title="plus balance" width="30px">
                </div>
            </div>
        </div>
        <div class="card main-card">
            <img id="plusStations" src="{{ mix("/resources/assets/add-plus-button.png")  }}" alt="plus balance"
                 title="plus balance" width="30px">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    @foreach($stations as $s)
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

        <button style="position:fixed;
            right:0;
            bottom:0;">
            <img id="plusBalance" src="{{ mix("/resources/assets/add-plus-button.png")  }}" alt="plus balance"
                 title="plus balance" width="30px">
        </button>
    </div>

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="balanceModal">
        ...
    </div>
@endsection
