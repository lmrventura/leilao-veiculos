@extends('layouts.main')

@section('title', 'Leilões')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um carro</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Leilões</h2>
    <p class="subtitle">Veja os carros disponíveis</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($auctions as $auction)
        <div class="card col-md-3">
            <!-- <img src="/img/vehicles/{{ $auction->vehicle->images->first()->path }}" alt="{{ $auction->vehicle->model }}"> -->
            @if($auction->vehicle->images->isNotEmpty())
                <img src="/{{ $auction->vehicle->images->first()->path }}" class="img-fluid" alt="{{ $auction->vehicle->model }}">
            @else
                <img src="/path/to/default/image.jpg" class="img-fluid" alt="Default Image">
            @endif
            
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($auction->start_time)) }}</p>
                <h5 class="card-title">{{ $auction->vehicle->make }} {{ $auction->vehicle->model }}</h5>
                <p class="card-participants"> Lance inicial: R$ {{number_format($auction->starting_bid, 2, ',', '.')}} </p>
                <a href="/auctions/{{ $auction->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        
        @if(count($auctions) == 0 && $search)
            <p>Não foi possível encontrar nenhum leilão de {{ $search }}! <a href="/">Ver todos</a></p>
        @elseif(count($auctions) == 0)
            <p>Não há leilões disponíveis</p>
        @endif    
    </div>
</div>

@endsection