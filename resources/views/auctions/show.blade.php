@extends('layouts.main')

@section('title', $vehicle->model.'-'.$auction->id)

@section('content')

  <div class="col-md-10 offset-md-1">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/vehicles/{{ $vehicle->image }}" class="img-fluid" alt="{{ $vehicle->model }}">
      </div>

      <div id="vehicleCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach($auction->vehicle->images as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="/img/vehicles/{{ $image->url }}" class="d-block w-100" alt="{{ $vehicle->model }}">
            </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div id="info-container" class="col-md-6">
        <h1>{{ $vehicle->make }} {{$vehicle->model}}</h1>
        <p class="event-city"><ion-icon name="calendar-outline"></ion-icon> Ano: {{ $vehicle->year }}</p>
        <p class="events-participants"><ion-icon name="people-outline"></ion-icon> Combustível {{ $vehicle->fuel }} </p>
        <p class="auction-owner"><ion-icon name="person-outline"></ion-icon> Dono do Leilão: {{ $auctionOwner['name'] }}</p>
        
        <p class="event-owner"><ion-icon name="star-outline"></ion-icon> R$ {{  $auction->starting_bid }}</p>
        
        {{-- @if(!$hasUserJoined) --}}

        @if(!$isUsersLastBid)
          <p class="msg">O último lance foi seu!</p>
        @endif

        @if($isUsersLastBid) 
          <form action="/auctions/bid/{{ $auction->id }}" method="POST">
            @csrf
            <a href="/auctions/bid/{{ $auction->id }}" 
              class="btn btn-primary" 
              id="event-submit"
              onclick="event.preventDefault();
              this.closest('form').submit();"
            >
              R$ 300
            </a>
          </form>
        @else
          <p class="already-joined-msg">Você já está participando deste leilão!</p>
        @endif

        <h3>O veículo conta com:</h3>
        <ul id="items-list">
        @foreach($vehicle->optionals as $optional)
          <li><ion-icon name="play-outline"></ion-icon> <span>{{ $optional->name }}</span></li>
        @endforeach
        </ul>
      </div>
      <div class="col-md-12" id="description-container">
        <h3>Sobre o Carro:</h3>
        <p class="event-description">{{ $auction->vehicle->description }}</p>
      </div>
    </div>
  </div>

@endsection