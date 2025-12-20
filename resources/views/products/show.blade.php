<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #fff; }
        .container { max-width: 900px; margin: 0 auto; padding: 20px; }
        h1 { font-size: 24px; color: #000; margin-bottom: 20px; }
        h2 { font-size: 20px; color: #000; margin: 20px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #fff; color: #000; text-decoration: none; border: 1px solid #000; cursor: pointer; }
        .card { background: #fff; border: 1px solid #000; padding: 30px; margin-bottom: 20px; }
        .detail-row { display: flex; padding: 10px 0; border-bottom: 1px solid #000; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-weight: bold; color: #000; width: 200px; }
        .detail-value { color: #000; flex: 1; }
        .actions { display: flex; gap: 10px; margin-top: 20px; }
        .product-photo { max-width: 300px; max-height: 300px; object-fit: contain; border: 1px solid #000; display: block; margin: 0 auto 20px; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <h1>Product Details</h1>
        
        <div class="card">
            @if($product->photo)
                <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="product-photo">
            @endif
            
            <h2>{{ $product->name }}</h2>
            
            <div class="detail-row">
                <div class="detail-label">Description:</div>
                <div class="detail-value">{{ $product->description }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Created At:</div>
                <div class="detail-value">{{ $product->created_at ? $product->created_at->format('Y-m-d H:i:s') : 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Updated At:</div>
                <div class="detail-value">{{ $product->updated_at ? $product->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</div>
            </div>
            
            <div class="actions">
                <a href="{{ route('admin.products.index') }}" class="btn">Back</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn">Edit</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
