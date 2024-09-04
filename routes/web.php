<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\VehicleController;

//  VEHICLES
Route::get('/vehicles/create', [VehicleController::class, 'create']);

Route::get('/', [AuctionController::class, 'index']);
Route::get('/auctions/create', [AuctionController::class, 'create'])->middleware('auth');
Route::get('/auctions/{id}', [AuctionController::class, 'show']);
Route::post('/auctions', [AuctionController::class, 'store']);
Route::delete('/auctions/{id}', [AuctionController::class, 'destroy'])->middleware('auth');
Route::get('/auctions/edit/{id}', [AuctionController::class, 'edit'])->middleware('auth');
Route::put('/auctions/update/{id}', [AuctionController::class, 'update'])->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/dashboard', [AuctionController::class, 'dashboard'])->middleware('auth');

Route::post('/auctions/join/{id}', [AuctionController::class, 'joinAuction'])->middleware('auth');

Route::delete('/auctions/leave/{id}', [AuctionController::class, 'leaveAuction'])->middleware('auth');