<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
</head>
<body>
    <h1>Inventory</h1>
    
    <h2>Add New Product</h2>
    <form method="POST" action="{{ route('inventory.storeProduct') }}">
        @csrf
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="name" required>
        <button type="submit">Add Product</button>
    </form>

    <h2>Add New Store</h2>
    <form method="POST" action="{{ route('inventory.storeStore') }}">
        @csrf
        <label for="store_name">Store Name:</label>
        <input type="text" id="store_name" name="name" required>
        <button type="submit">Add Store</button>
    </form>

    <h2>Add New Warehouse</h2>
    <form method="POST" action="{{ route('inventory.storeWarehouse') }}">
        @csrf
        <label for="warehouse_name">Warehouse Name:</label>
        <input type="text" id="warehouse_name" name="name" required>
        <button type="submit">Add Warehouse</button>
    </form>

    <h2>Inventory Table</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Barang</th>
                @foreach($stores as $store)
                    <th>{{ $store->name }}</th>
                @endforeach
                @foreach($warehouses as $warehouse)
                    <th>{{ $warehouse->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    @foreach($stores as $store)
                        <td>
                            <form method="POST" action="{{ route('inventory.updateQuantityStore', ['productId' => $item->id, 'storeId' => $store->id]) }}">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->stores[$store->id] ?? 0 }}">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                    @endforeach
                    @foreach($warehouses as $warehouse)
                    <td>
                        <form method="POST" action="{{ route('inventory.updateQuantityWarehouse', ['productId' => $item->id, 'warehouseId' => $warehouse->id]) }}">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->warehouses[$warehouse->id] ?? 0 }}">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                @endforeach
                
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
