<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory/product', [InventoryController::class, 'storeProduct'])->name('inventory.storeProduct');
Route::post('/inventory/store', [InventoryController::class, 'storeStore'])->name('inventory.storeStore');
Route::post('/inventory/warehouse', [InventoryController::class, 'storeWarehouse'])->name('inventory.storeWarehouse');
Route::put('/inventory/store/{productId}/{storeId?}', [InventoryController::class, 'updateQuantityStore'])->name('inventory.updateQuantityStore');
Route::put('/inventory/warehouse/{productId}/{warehouseId?}', [InventoryController::class, 'updateQuantityWarehouse'])->name('inventory.updateQuantityWarehouse');
