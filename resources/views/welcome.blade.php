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
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participants"> {{ count($event->users) }} Participantes</p>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
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