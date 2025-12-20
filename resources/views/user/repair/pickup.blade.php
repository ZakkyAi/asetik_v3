<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickup Repair - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; min-height: 100vh; }
        
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .navbar-menu { display: flex; gap: 30px; align-items: center; }
        .navbar-menu a { color: white; text-decoration: none; font-weight: 500; transition: opacity 0.3s; padding: 8px 16px;  }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 40px; height: 40px;  background: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 18px; overflow: hidden; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 8px 20px;  cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }
        .container { max-width: 1400px; margin: 0 auto; padding: 30px; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #333; margin-bottom: 10px; }
        .page-header p { color: #666; font-size: 16px; }
        .repairs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        .repair-card { background: white;  padding: 25px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); }
        .repair-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; }
        .repair-id { font-size: 18px; font-weight: 600; color: #667eea; }
        .badge { display: inline-block; padding: 6px 14px;  font-size: 12px; font-weight: 600; }
        .badge-fixing { background: #ff9800; color: white; }
        .badge-good { background: #43e97b; color: white; }
        .repair-info { margin-bottom: 10px; font-size: 14px; color: #666; }
        .repair-info strong { color: #333; }
        .product-image { width: 100%; height: 180px; object-fit: cover;  margin: 15px 0; background: #f0f0f0; }
        .btn-pickup { display: block; width: 100%; padding: 12px; background: #43e97b; color: white; text-align: center; text-decoration: none;  margin-top: 15px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-pickup:hover { background: #38d66c; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4); }
        .btn-pickup:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }
        .empty-state { text-align: center; padding: 80px 20px; color: #999; background: white;  }
        .empty-state h3 { font-size: 24px; margin-bottom: 10px; color: #666; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <div class="page-header">
            <h1>Pickup Repair</h1>
            <p>View and pickup your repaired items</p>
        </div>
        
        @if($pickupRepairs->count() > 0)
            <div class="repairs-grid">
                @foreach($pickupRepairs as $repair)
                <div class="repair-card">
                    <div class="repair-header">
                        <div class="repair-id">Repair #{{ $repair->id_repair }}</div>
                        <span class="badge badge-{{ $repair->record->status }}">
                            {{ ucfirst($repair->record->status) }}
                        </span>
                    </div>
                    
                    @if($repair->record->product && $repair->record->product->photo)
                        <img src="{{ asset($repair->record->product->photo) }}" alt="{{ $repair->record->product->name }}" class="product-image">
                    @else
                        <div class="product-image" style="display: flex; align-items: center; justify-content: center; font-size: 48px; color: #ccc;">
                            📦
                        </div>
                    @endif
                    
                    <div class="repair-info">
                        <strong>Product:</strong> {{ $repair->record->product ? $repair->record->product->name : 'N/A' }}
                    </div>
                    <div class="repair-info">
                        <strong>Serial:</strong> {{ $repair->record->no_serial }}
                    </div>
                    <div class="repair-info">
                        <strong>Inventory:</strong> {{ $repair->record->no_inventaris }}
                    </div>
                    <div class="repair-info">
                        <strong>Repair Note:</strong> {{ $repair->note }}
                    </div>
                    <div class="repair-info">
                        <strong>Submitted:</strong> {{ $repair->created_at ? \Carbon\Carbon::parse($repair->created_at)->format('d M Y H:i') : 'N/A' }}
                    </div>
                    
                    @if($repair->record->status === 'good')
                        <button class="btn-pickup" onclick="alert('Item is ready for pickup! Please contact admin to collect your item.')">
                            ✓ Ready for Pickup
                        </button>
                    @else
                        <button class="btn-pickup" disabled>
                            ⏳ Still in Repair
                        </button>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>No items to pickup</h3>
                <p>You don't have any items ready for pickup at the moment.</p>
            </div>
        @endif
    </div>
</body>
</html>
