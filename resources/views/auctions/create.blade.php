@extends('layouts.main')

@section('title', 'Cadastrar Carro')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <h1>Cadastrar carro</h1>
  <form action="/auctions" method="POST" enctype="multipart/form-data">
    @csrf
    {{--
      <div class="form-group">
        <label for="image">Imagem do Carro:</label>
        <input type="file" id="image" name="image" class="from-control-file" onchange="previewImage(event)">
      </div>

      <div class="form-group">
        <img id="image-preview" src="#" alt="Pré-visualização da imagem" style="max-width: 15%; height: 15%; display: none;">
      </div> 
    --}}

    <div class="form-group">
      <label for="images">Imagem do Carro:</label>
      <input type="file" id="images" name="images[]" class="form-control-file" multiple onchange="previewImages(event)">
    </div>

    <div class="form-group" id="image-preview-container">
      <!-- As pré-visualizações das imagens serão exibidas aqui -->
    </div>

    <div class="form-group">
    <label for="make">Fabricante:</label>
    <select class="form-control" id="make" name="make" required>
        <option value="" disabled selected>Escolha o fabricante do carro</option>
        <!-- Marcas Americanas -->
        <option value="Ford">Ford</option>
        <option value="Chevrolet">Chevrolet</option>
        <option value="Dodge">Dodge</option>
        <option value="Tesla">Tesla</option>
        <option value="Chrysler">Chrysler</option>
        <option value="Cadillac">Cadillac</option>

        <!-- Marcas Européias -->
        <option value="Volkswagen">Volkswagen</option>
        <option value="BMW">BMW</option>
        <option value="Mercedes-Benz">Mercedes-Benz</option>
        <option value="Audi">Audi</option>
        <option value="Porsche">Porsche</option>
        <option value="Volvo">Volvo</option>
        <option value="Renault">Renault</option>
        <option value="Peugeot">Peugeot</option>
        <option value="Fiat">Fiat</option>
        <option value="Ferrari">Ferrari</option>
        <option value="Lamborghini">Lamborghini</option>
        <option value="Bentley">Bentley</option>
        <option value="Jaguar">Jaguar</option>
        <option value="Aston Martin">Aston Martin</option>

        <!-- Marcas Asiáticas -->
        <option value="Toyota">Toyota</option>
        <option value="Honda">Honda</option>
        <option value="Nissan">Nissan</option>
        <option value="Mazda">Mazda</option>
        <option value="Subaru">Subaru</option>
        <option value="Mitsubishi">Mitsubishi</option>
        <option value="Hyundai">Hyundai</option>
        <option value="Kia">Kia</option>
        <option value="Suzuki">Suzuki</option>
        <option value="Lexus">Lexus</option>

        <!-- Marcas de Luxo e Superesportivos -->
        <option value="Rolls-Royce">Rolls-Royce</option>
        <option value="Maserati">Maserati</option>
        <option value="Bugatti">Bugatti</option>
        <option value="McLaren">McLaren</option>
    </select>
</div>

    <div class="form-group">
      <label for="model">Modelo:</label>
      <input type="text" class="form-control" id="model" name="model" placeholder="Modelo do carro" required>
    </div>

    <div class="form-group">
      <label for="year">Ano:</label>
      <select class="form-control" id="year" name="year" required>
          <option value="" disabled selected>Escolha o ano de fabricação</option>
          @for($year = 2024; $year >= 1965; $year--)
              <option value="{{ $year }}">{{ $year }}</option>
          @endfor
      </select>
  </div>

    <div class="form-group">
      <label for="fuel">Combustível:</label>
      <select class="form-control" name="fuel" id="fuel">
        <option value="" disabled selected>Ecolha o tipo de combustível</option>  
        <option value="gasoline">Gasoline</option>
        <option value="diesel">Diesel</option>
        <option value="gnv">GNV</option>
        <option value="flex">Flex</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="km">Quilometragem:</label>
      <input type="number" class="form-control" id="km" name="km" placeholder="Quilometragem" required>
    </div>
    
    <div class="form-group">
      <label for="doors">Número de portas:</label>
      <select class="form-control" name="doors" id="doors" required>
        <option value="" disabled selected>Escolha o número de portas</option>
        <option value="2P">2P</option>
        <option value="3P">3P</option>
        <option value="4P">4P</option>
      </select>
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
      <label for="transmission">Câmbio</label>
      <select class="form-control" name="transmission" id="transmission">
        <option value="" disabled selected>Escolha o tipo de câmbio</option>
        <option value="manual">Manual</option>
        <option value="automatic">Automático</option>
        <option value="automated">Automatizado</option>
      </select>
    </div>

    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control" placeholder="Apontamentos sobre o carro."></textarea>
    </div>
    
    </br>
    <div class="form-group">
      <label for="title">Opcionais:</label>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Air bag duplo"> Air bag duplo
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Freios ABS"> Freios ABS
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Vidro Elétrico"> Vidro Elétrico
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Espelhos Elétricos"> Espelhos Elétricos
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Trava Elétrica"> Trava Elétrica
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Direção Hidráulica"> Direção Hidráulica
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Sensor De Ré"> Sensor De Ré
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Ar Condicionado"> Ar Condicionado
      </div>
      <div class="form-group">
        <input type="checkbox" name="optionals[]" value="Rodas de Liga Leve"> Rodas de Liga Leve
      </div>
    </div>

    </br>
    <div class="form-group">
      <label for="Documentation">Documentação:</label>
      <div class="form-group">
        <div class="form-group"><input type="checkbox" name="documentation[]" value="Licenciado">IPVA Pago</div>
        <div class="form-group"><input type="checkbox" name="documentation[]" value="With Fines">Com multas</div>
        <div class="form-group"><input type="checkbox" name="documentation[]" value="From Auction">De leilão</div></div>
    </div>

    <div class="form-group">
      <label for="starting_bid">Lance Inicial:</label>
      <input type="number" class="form-control" id="starting_bid" name="starting_bid" placeholder="Lance inicial do leilão" required> {{-- step="1000" --}}
    </div>

    {{--
    <div class="form-group">
      <label for="status">Status:</label>
      <select class="form-control" id="status" name="status">
        <option value="open">Aberto</option>
        <option value="closed">Fechado</option>
      </select>
    </div>  
    --}}

    <div class="form-group">
      <label for="start_time">Data e Hora de Início:</label>
      <input type="datetime-local" class="form-control" id="start_time" name="start_time">
    </div>

    <div class="form-group">
      <label for="end_time">Data e Hora de Término:</label>
      <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
    </div>

    <input type="submit" class="btn btn-primary" value="Cadastrar Carro">
  </form>
</div>

<script>
  function previewImages(event) {
    var input = event.target;
    var previewContainer = document.getElementById('image-preview-container');

    previewContainer.innerHTML = ""; // Limpa pré-visualizações anteriores

    for (var i = 0; i < input.files.length; i++) {
      (function(file) { // Função auto-executável para capturar o valor do arquivo
        var reader = new FileReader();
        
        reader.onload = function(event) {
          var imgElement = document.createElement('img');
          imgElement.src = event.target.result;
          imgElement.style.maxWidth = '15%';
          imgElement.style.height = '15%';
          imgElement.style.marginRight = '10px'; // Espaço entre as imagens
          previewContainer.appendChild(imgElement);
        }
        
        reader.readAsDataURL(file); // Lê a imagem como uma URL
      })(input.files[i]);
    }
  }
  // function previewImage(event) {
  //   var input = event.target;
  //   var reader = new FileReader();
    
  //   reader.onload = function(){
  //     var imgElement = document.getElementById('image-preview');
  //     imgElement.src = reader.result;
  //     imgElement.style.display = 'block'; // Exibe a imagem
  //   };
    
  //   reader.readAsDataURL(input.files[0]); // Lê a imagem como uma URL
  // }
</script>

@endsection