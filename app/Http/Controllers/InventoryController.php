<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\InventoryStore;
use App\Models\InventoryWarehouse;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $stores = Store::all();
        $warehouses = Warehouse::all();
    
        $inventory = [];
    
        foreach ($products as $product) {
            $productData = new \stdClass(); 
            $productData->id = $product->id;
            $productData->name = $product->name;
            $productData->stores = [];
            $productData->warehouses = [];
    
            foreach ($stores as $store) {
                $inventoryStore = InventoryStore::where('product_id', $product->id)
                                                 ->where('store_id', $store->id)
                                                 ->first();
                $productData->stores[$store->id] = $inventoryStore ? $inventoryStore->quantity : 0;
            }
    
            foreach ($warehouses as $warehouse) {
                $inventoryWarehouse = InventoryWarehouse::where('product_id', $product->id)
                                                         ->where('warehouse_id', $warehouse->id)
                                                         ->first();
                $productData->warehouses[$warehouse->id] = $inventoryWarehouse ? $inventoryWarehouse->quantity : 0;
            }
    
            $inventory[] = $productData;
        }
    
        return view('inventory.index', compact('inventory', 'stores', 'warehouses'));
    }
    

    public function storeProduct(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $product = Product::create(['name' => $request->name]);

        foreach (Store::all() as $store) {
            InventoryStore::create(['product_id' => $product->id, 'store_id' => $store->id, 'quantity' => 0]);
        }

        foreach (Warehouse::all() as $warehouse) {
            InventoryWarehouse::create(['product_id' => $product->id, 'warehouse_id' => $warehouse->id, 'quantity' => 0]);
        }

        return redirect()->back();
    }

    public function storeStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $store = Store::create(['name' => $request->name]);

        foreach (Product::all() as $product) {
            InventoryStore::create(['product_id' => $product->id, 'store_id' => $store->id, 'quantity' => 0]);
        }

        return redirect()->back();
    }

    public function storeWarehouse(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $warehouse = Warehouse::create(['name' => $request->name]);

        foreach (Product::all() as $product) {
            InventoryWarehouse::create(['product_id' => $product->id, 'warehouse_id' => $warehouse->id, 'quantity' => 0]);
        }

        return redirect()->back();
    }

    public function updateQuantityStore(Request $request, $productId, $storeId = null)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);
    
        try {
            $inventory = InventoryStore::where('product_id', $productId)
                                       ->where('store_id', $storeId)
                                       ->first();
    
            if (!$inventory) {
                $inventory = new InventoryStore();
                $inventory->product_id = $productId;
                $inventory->store_id = $storeId;
            }
    
            $inventory->quantity = $request->quantity;
            $inventory->save();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui jumlah inventaris: ' . $e->getMessage()]);
        }
    }

    public function updateQuantityWarehouse(Request $request, $productId, $warehouseId = null)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);
    
        try {
            $inventory = InventoryWarehouse::where('product_id', $productId)
                                           ->where('warehouse_id', $warehouseId)
                                           ->first();
    
            if (!$inventory) {
                $inventory = new InventoryWarehouse();
                $inventory->product_id = $productId;
                $inventory->warehouse_id = $warehouseId;
            }
    
            $inventory->quantity = $request->quantity;
            $inventory->save();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui jumlah inventaris: ' . $e->getMessage()]);
        }
    }
    
}
