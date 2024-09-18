<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Optional;
use App\Models\User;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    
    public function index() {
        $search = request('search');

        if($search) {
            $auctions = Auction::where([
                ['title', 'like', '%'.$search.'%']
            ]);
        }else {
            $auctions = Auction::all();
        }
        
        $vehicles = Vehicle::all();
        return view('welcome',[
            'auctions' => $auctions,
            'search' => $search,
            'vehicles' => $vehicles
        ]);
    }

    public function dashboard() {
        return view('/');
    }

    public function create() {
        return view('/auctions.create');
    }

    public function store(Request $request) {   
        $validatedData = $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'fuel' => 'required|string',
            'km' => 'required|integer',
            'doors' => 'required|string',
            'color' => 'required|string',
            'plate' => 'required|string',
            'transmission' => 'required|string',
            'description' => 'nullable|string',
            'starting_bid' => 'required|numeric',
            'start_time' => 'nullable|date',
            'end_time' => 'required|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:4048', // Validação das imagens 2048
        ]);
    
        try {
            // Criar o veículo
            DB::transaction(function () use ($request, $validatedData) {
                // Criar o veículo
                $vehicle = Vehicle::create([
                    'make' => $validatedData['make'],
                    'model' => $validatedData['model'],
                    'year' => $validatedData['year'],
                    'fuel' => $validatedData['fuel'],
                    'km' => $validatedData['km'],
                    'doors' => $validatedData['doors'],
                    'color' => $validatedData['color'],
                    'plate' => $validatedData['plate'],
                    'transmission' => $validatedData['transmission'],
                    'description' => $validatedData['description'],
                ]);

                // Verificar se o veículo foi criado com sucesso
                if (!$vehicle) {
                    throw new Exception('Erro ao criar o veículo.');
                }

                // Fazer upload das imagens do veículo
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('images/vehicles'), $imageName);

                        // Relacionamento Vehicle -> Image
                        $vehicle->images()->create(['path' => 'images/vehicles/' . $imageName]);
                    }
                }

                if($request->has('optionals')) {
                    $optionals = $request->input('optionals');
                    foreach($optionals as $optionalName) {
                        // Encontrar ou criar o opcional
                        $optional = Optional::firstOrCreate(['name' => $optionalName]);
                        
                        // Associar o veículo ao opcional na tabela pivot
                        $vehicle->optionals()->attach($optional->id);
                        // $vehicle->optionals()->syncWithoutDetaching($optional->id);
                    }
                }

                // Criar o leilão associado ao veículo
                $user = auth()->user();
                // if($vehicle) {
                // }else {
                    // Caso ocorra um erro, lançar uma exceção para desfazer a transação
                //     throw new Exception('Erro ao criar o veículo');
                // }

                // Criar a entrada para `Auction`
                Auction::create([
                    'user_id' => $user->id,
                    'vehicle_id' => $vehicle->id, // Relaciona o leilão com o veículo criado
                    'starting_bid' => $validatedData['starting_bid'],
                    'status' => 'open',  // Status inicial definido como "open"
                    'start_time' => $validatedData['start_time'],
                    'end_time' => $validatedData['end_time']
                ]);
            });

            return redirect('/')->with('msg', 'Vehicle created successfully.');
            // return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
            // return view('/auctions.create');
        }catch (Exception $e) {
            // Caso ocorra uma exceção, redirecionar com mensagem de erro
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }

    public function show($id) {
        $auction = Auction::findOrFail($id); //$auction = Auction::where('id', $id);
        $auctionOwner = User::where('id', $auction->user_id)->first()->toArray();
        $vehicle = Vehicle::where('id', $auction->vehicle_id)->first(); 

        $user = auth()->user();
        $isUsersLastBid = false;

        // Recupera o último lance associado ao leilão, ordenado por 'id' ou 'date_time'
        // $lastBid = $auction->bids()->latest('id')->first(); // ou 'date_time' se for baseado em tempo

        // Verifica se o último lance pertence ao usuário autenticado
        // if ($lastBid && $lastBid->buyer_id == $user->id) {
        //     $isUsersLastBid = true;
        // }

        $bids = $auction->bids()->get()->toArray(); // $bids = $auction->bids()->toArray();
        forEach($bids as $index => $bid) {
            // Se for o último
            if($index === array_key_last($bids)) {
                if($bid['buyer_id'] == $user->id && $bid['id' > 1]){ //if($bid['buyer_id'] == $user->id){
                    $isUsersLastBid = true;
                }
            }
        }

        // $lastBid = $auction->bids()->latest('id')->first();
        // if($lastBid) {
        //     $lastBid->toArray();
        // }else{
        //     $lastBid = [];
        // }

        // if lastbid > starting_bid
        $bids = Bid::where('auction_id', $id)->get();
        $lastBid = Bid::where('auction_id', $id)->orderBy('created_at', 'desc')->first();

        return view(
            'auctions.show', [
                'auction' => $auction,
                'auctionOwner' => $auctionOwner,
                'vehicle' => $vehicle,
                'isUsersLastBid' => $isUsersLastBid,
                'lastBid' => $lastBid,
                'bids' => $bids
            ]);
    }

    public function bidOnTheCar($id) {
        $user = auth()->user();

        $bid = Bid::create([
            'date_time' => now(),
            'value' => 300,
            'auction_id' => $id,
            'buyer_id' => $user->id
        ]);

        return redirect()->route('auctions.show', ['id' => $id, 'bid' => $bid]); // redirect("/auctions/{$id}");
    }
}
