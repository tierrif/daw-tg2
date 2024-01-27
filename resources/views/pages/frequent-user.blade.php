@extends('main')

@section('content')
    <div class="container">
        <div class="card">
            <h4>Saldo: </h4>
        </div>
        <div class="card main-card">
            <div class="card-body row justify-content-around">
                <div class="lines col">
                    @foreach ($lines as $line)
                        <div class="row card line {{ $line->stringId }}">
                            <div class="card-body">
                                <div class="col">
                                    <span>Linha {{ $line->displayName }}</span>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="station-search col">
                    <span>aaa</span>
                </div>
            </div>
        </div>
    </div>
@endsection
