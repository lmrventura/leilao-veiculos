<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index() {
        $vehicles = Vehicle::all();
        // return view('vehicles.index', compact('vehicles'));
        return view('welcome', [$vehicles]);
    }

    public function create() {
        return view('vehicles.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'fuel' => 'required|string|max:255',
            'km' => 'required|integer',
            'doors' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'plate' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'items' => 'nullable|array',
            'description' => 'nullable|string',
            'starting_bid' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]);

        // Tratamento das imagens
        $imagePaths = [];
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }
        }
        
        Vehicle::create($validatedData);
        return response()->json(['message' => 'Vehicle created successfully'], 201);
        // return redirect('/')->with('msg', 'Veículo foi criado com sucesso!');


        

        // Criar a entrada para `Vehicle`
        $vehicle = Vehicle::create([
            'image' => json_encode($imagePaths), // Armazena os caminhos das imagens como JSON
            'make' => $validatedData['make'],
            'model' => $validatedData['model'],
            'year' => $validatedData['year'],
            'fuel' => $validatedData['fuel'],
            'km' => $validatedData['km'],
            'doors' => $validatedData['doors'],
            'color' => $validatedData['color'],
            'plate' => $validatedData['plate'],
            'shift' => $validatedData['transmission'],
            'optionals' => json_encode($validatedData['items'] ?? []),
            'description' => $validatedData['description'],
        ]);

        // Redireciona com mensagem de sucesso
        return redirect('/dashboard')->with('msg', 'Vehicle and Auction created successfully.');
        }
}
