@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie o seu evento</h1>
  <form action="/events" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="image">Imagem do Carro:</label>
      <input type="file" id="image" name="image" class="from-control-file">
    </div>

    <div class="form-group">
      <label for="title">Nome do Carro</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
    </div>
    <div class="form-group">
      <label for="make">Fabricante:</label>
      <input type="text" class="form-control" id="make" name="make" placeholder="Fabricante do carro">
    </div>
    <div class="form-group">
      <label for="model">Modelo:</label>
      <input type="text" class="form-control" id="model" name="model" placeholder="Modelo do carro">
    </div>
    <div class="form-group">
      <label for="year">Ano:</label>
      <input type="number" class="form-control" id="year" name="year" placeholder="Ano de fabricação">
    </div>
    <div class="form-group">
      <label for="fuel">Combustível:</label>
      <input type="text" class="form-control" id="fuel" name="fuel" placeholder="Tipo de combustível">
    </div>
    <div class="form-group">
      <label for="km">Quilometragem:</label>
      <input type="number" class="form-control" id="km" name="km" placeholder="Quilometragem">
    </div>
    <div class="form-group">
      <label for="doors">Número de portas:</label>
      <input type="text" class="form-control" id="doors" name="doors" placeholder="Número de portas">
    </div>
    <div class="form-group">
      <label for="color">Cor:</label>
      <input type="text" class="form-control" id="color" name="color" placeholder="Cor do carro">
    </div>
    <div class="form-group">
      <label for="plate">Placa:</label>
      <input type="text" class="form-control" id="plate" name="plate" placeholder="Placa do carro">
    </div>
    <div class="form-group">
      <label for="shift">Câmbio:</label>
      <input type="text" class="form-control" id="shift" name="shift" placeholder="Tipo de câmbio">
    </div>

    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
    </div>
    
    <div class="form-group">
      <label for="title">Opcionais:</label>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Air bag duplo"> Air bag duplo
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Freios ABS"> Freios ABS
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Vidro Elétrico"> Vidro Elétrico
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Espelhos Elétricos"> Espelhos Elétricos
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Trava Elétrica"> Trava Elétrica
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Direção Hidráulica"> Direção Hidráulica
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Sensor De Ré"> Sensor De Ré
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Ar Condicionado"> Ar Condicionado
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Rodas de Liga Leve"> Rodas de Liga Leve
      </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Cadastrar Carro">
  </form>
</div>

@endsection