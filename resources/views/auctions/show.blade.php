@extends('layouts.main')

@section('title', $vehicle->model.'-'.$auction->id)

@section('content')

  <div class="col-md-10 offset-md-1">
    <div class="row">
      @if($vehicle->images->isNotEmpty())
        <div id="image-container" class="col-md-6">
          <!-- <img src="/{{ $vehicle->images->first()->path }}" class="img-fluid" alt="{{ $vehicle->model }}">   </div> -->
          @foreach($vehicle->images as $image)
            <img src="/{{ $image->path }}" class="img-fluid" alt="{{ $vehicle->model }}">
          @endforeach
        </div>
      @else
          <p>Imagem não disponível</p>
      @endif
      {{-- 
            <img src="/img/vehicles/{{ $vehicle->images->first()->path }}" class="img-fluid" alt="{{ $vehicle->model }}">
            A imagem não está sendo exibida quando você utiliza o caminho /img/vehicles/ porque o valor de path no banco de dados já contém o caminho completo onde as imagens estão armazenadas, que é images/vehicles/. 
      --}}

      <div id="info-container" class="col-md-6">
        <h1>{{ $vehicle->make }} {{$vehicle->model}}</h1>
        <p class="event-city"><ion-icon name="calendar-outline"></ion-icon> Ano: {{ $vehicle->year }}</p>
        <p class="events-participants"><ion-icon name="people-outline"></ion-icon> Combustível {{ $vehicle->fuel }} </p>
        <p class="auction-owner"><ion-icon name="person-outline"></ion-icon> Dono do Leilão: {{ $auctionOwner['name'] }}</p>
        
        <p class="event-owner"><ion-icon name="star-outline"></ion-icon> Início: R$ {{  $auction->starting_bid }}</p>
        @if($lastBid)
          <p class="event-owner"><ion-icon name="star-outline"></ion-icon> Último lance: R$ {{$lastBid->value}}</p>
        @endif
        
        {{-- @if(!$hasUserJoined) --}}

        @if(auth()->check() && !$isUsersLastBid)
          <p class="msg">O último lance foi seu!</p>
        @endif

        <form action="/auctions/bid/{{ $auction->id }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">
              R$ 300
          </button>
        </form>

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