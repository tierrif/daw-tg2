@extends('main')

@section('content')
<div class="container">
    <h1 class="site-title h2">Planeador de Viagens para o Metropolitano de Lisboa</h1>
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
