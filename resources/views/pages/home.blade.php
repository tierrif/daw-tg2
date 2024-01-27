@extends('main')

@section('content')
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
                            <div class="col checkmark" data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="">
                                <img src="{{ mix('resources/assets/checkmark.png') }}" width="30" />
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
    <input id="lines" type="hidden" value="{{ json_encode($lines) }}" />
@endsection
