<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\InventoryStore;
use App\Models\InventoryWarehouse;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Buat data produk
        $products = ['Product A', 'Product B', 'Product C', 'Product D'];
        foreach ($products as $product) {
            Product::create(['name' => $product]);
        }

        // Buat data toko
        $stores = ['Store A', 'Store B', 'Store C'];
        foreach ($stores as $store) {
            Store::create(['name' => $store]);
        }

        // Buat data gudang
        $warehouses = ['Warehouse A', 'Warehouse B'];
        foreach ($warehouses as $warehouse) {
            Warehouse::create(['name' => $warehouse]);
        }

        // Buat data inventory store
        InventoryStore::create(['product_id' => 1, 'store_id' => 1, 'quantity' => 10]);
        InventoryStore::create(['product_id' => 2, 'store_id' => 1, 'quantity' => 12]);
        InventoryStore::create(['product_id' => 3, 'store_id' => 1, 'quantity' => 15]);
        InventoryStore::create(['product_id' => 1, 'store_id' => 2, 'quantity' => 14]);
        InventoryStore::create(['product_id' => 3, 'store_id' => 2, 'quantity' => 17]);
        InventoryStore::create(['product_id' => 4, 'store_id' => 2, 'quantity' => 19]);
        InventoryStore::create(['product_id' => 3, 'store_id' => 3, 'quantity' => 20]);
        InventoryStore::create(['product_id' => 4, 'store_id' => 3, 'quantity' => 17]);

        // Buat data inventory warehouse
        InventoryWarehouse::create(['product_id' => 1, 'warehouse_id' => 1, 'quantity' => 11]);
        InventoryWarehouse::create(['product_id' => 2, 'warehouse_id' => 1, 'quantity' => 13]);
        InventoryWarehouse::create(['product_id' => 3, 'warehouse_id' => 1, 'quantity' => 10]);
        InventoryWarehouse::create(['product_id' => 4, 'warehouse_id' => 1, 'quantity' => 14]);
        InventoryWarehouse::create(['product_id' => 1, 'warehouse_id' => 2, 'quantity' => 60]);
        InventoryWarehouse::create(['product_id' => 2, 'warehouse_id' => 2, 'quantity' => 55]);
        InventoryWarehouse::create(['product_id' => 4, 'warehouse_id' => 2, 'quantity' => 20]);
    }
}
