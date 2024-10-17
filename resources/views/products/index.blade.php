<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div class="container">
        <a href="{{ route('logout') }}">
            <button type="button" class="btn-logout btn-sm">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Log out
            </button>
        </a>
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn create-product">
            <button type="button" class="create-product btn-primary">Create Product</button>
        </a>
      
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Product Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>{{ $product->description }}</td>
                    <td style="width:100px"><img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image"></td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('products.edit', $product->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Delete" id="delete-product" style="border: none; background: none; cursor: pointer;"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- <a href="{{ route('logout') }}">Logout</a> -->
    </div>
</body>
</html>
