<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Vehicle;
use Illuminate\Http\Request;

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
        
        return view('welcome',[
            'auctions' => $auctions,
            'search' => $search
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validação das imagens
        ]);
    
        DB::transaction(function () use ($request) {
            // Criar o veículo
            $vehicle = Vehicle::create([
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'fuel' => $request->fuel,
                'km' => $request->km,
                'doors' => $request->doors,
                'color' => $request->color,
                'plate' => $request->plate,
                'transmission' => $request->transmission,
                'description' => $request->description,
            ]);
        
            // Fazer upload das imagens do veículo
            if($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/vehicles'), $imageName);
                    
                    // Relacionamento Vehicle -> Image
                    $vehicle->images()->create(['path' => 'images/vehicles/' . $imageName]);
                }
            }
        });

        // Criar a entrada para `Auction`
        Auction::create([
            'vehicle_id' => $vehicle->id, // Relaciona o leilão com o veículo criado
            'starting_bid' => $validatedData['starting_bid'],
            'status' => 'open', // Status inicial definido como "open"
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time']
        ]);
    
        return redirect('/dashboard')->with('msg', 'Vehicle created successfully.');
        // return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
        // return view('/auctions.create');
    }
}
