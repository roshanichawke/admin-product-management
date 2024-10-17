<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
    <a href="{{ route('products.index') }}" title="Back to Products ">Back</a>
        <a href="{{ route('logout') }}">
            <button type="button" class="btn-logout btn-sm">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Log out
            </button>
        </a>
        <h1>{{ $product->name }}</h1>
        <p>Amount: {{ $product->amount }}</p>
        <p>Description: {{ $product->description }}</p>
        @if($product->image)
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%;">
            <!-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%;"> -->
        @endif
        <!-- <div style="margin-top:20px;">
            <a href="{{ route('products.index') }}"><button type="button">Back to Products</button></a>
        </div> -->
    </div>
</body>
</html>
