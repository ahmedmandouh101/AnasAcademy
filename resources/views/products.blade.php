

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

</head>
<body>
    <h1>Products</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="/products/{{ $product->id }}/edit">Edit</a>
                        <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h2>Add a New Product</h2>
    <form action="/products" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        <br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
