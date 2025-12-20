<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fff; min-height: 100vh; }
        .navbar { background: #fff; color: #000; padding: 0 30px;  position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; text-decoration: none; color: #000; }
        .navbar-menu { display: flex; gap: 30px; }
        .navbar-menu a { color: #000; text-decoration: none; padding: 8px 16px;  }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: #000; padding: 8px 20px;  cursor: pointer; font-weight: 600; }
        .container { max-width: 900px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #000; }
        .btn { display: inline-block; padding: 12px 24px; background: #fff; color: #000; text-decoration: none;  font-weight: 600;  border: none; cursor: pointer; }
        .btn:hover {   }
        .btn-secondary { background: #fff; }
        .card { background: white;  padding: 40px;  }
        .detail-row { display: flex; padding: 15px 0; border-bottom: 1px solid #000; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-weight: 600; color: #000; width: 200px; }
        .detail-value { color: #000; flex: 1; }
        .badge { display: inline-block; padding: 6px 16px;  font-size: 14px; font-weight: 600; }
        .badge-good { background: #fff; color: #000; }
        .badge-broken { background: #fff; color: #000; }
        .badge-not-taken { background: #fff; color: #000; }
        .badge-pending { background: #fff; color: #000; }
        .badge-fixing { background: #fff; color: #000; }
        .badge-decline { background: #999; color: #000; }
        .actions { display: flex; gap: 10px; margin-top: 30px; }
        .photos-section { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; padding: 40px; background: #fff;  margin-bottom: 30px; }
        .photo-card { text-align: center; background: white; padding: 30px;   }
        .user-photo-large { width: 180px; height: 180px;  object-fit: cover; border: 1px solid #000;  margin-bottom: 15px; }
        .product-photo-large { width: 200px; height: 200px; object-fit: contain;  border: 1px solid #000;  margin-bottom: 15px; background: white; }
        .default-avatar-large { width: 180px; height: 180px;  background: #fff; color: #000; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 70px;  margin-bottom: 15px; }
        .default-product-large { width: 200px; height: 200px;  background: #fff; color: #000; display: inline-flex; align-items: center; justify-content: center; font-size: 80px;  margin-bottom: 15px; }
        .photo-label { font-weight: 700; color: #000; font-size: 16px; text- letter-spacing: 1px; margin-bottom: 8px; }
        .photo-name { font-size: 18px; color: #000; font-weight: 600; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">🔐 Asetik</a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.users.index') }}">Users</a>
                <a href="{{ route('admin.products.index') }}">Products</a>
                <a href="{{ route('admin.records.index') }}" class="active">Records</a>
            </div>
            <div class="user-info">
                <strong>{{ auth()->user()->name }}</strong>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>📋 Record Details</h1>
            <a href="{{ route('admin.records.index') }}" class="btn btn-secondary">← Back</a>
        </div>

        <div class="card">
            <div class="photos-section">
                <div class="photo-card">
                    <div class="photo-label">👤 User</div>
                    @if($record->user && $record->user->photo)
                        <img src="{{ asset($record->user->photo) }}" alt="{{ $record->user->name }}" class="user-photo-large">
                    @else
                        <div class="default-avatar-large">
                            {{ $record->user ? strtoupper(substr($record->user->name, 0, 1)) : '?' }}
                        </div>
                    @endif
                    <div class="photo-name">{{ $record->user ? $record->user->name : 'N/A' }}</div>
                </div>
                
                <div class="photo-card">
                    <div class="photo-label">📦 Product</div>
                    @if($record->product && $record->product->photo)
                        <img src="{{ asset($record->product->photo) }}" alt="{{ $record->product->name }}" class="product-photo-large">
                    @else
                        <div class="default-product-large">
                            📦
                        </div>
                    @endif
                    <div class="photo-name">{{ $record->product ? $record->product->name : 'N/A' }}</div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">User:</div>
                <div class="detail-value"><strong>{{ $record->user ? $record->user->name : 'N/A' }}</strong></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Product:</div>
                <div class="detail-value"><strong>{{ $record->product ? $record->product->name : 'N/A' }}</strong></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status:</div>
                <div class="detail-value">
                    <span class="badge badge-{{ str_replace(' ', '-', $record->status) }}">
                        {{ ucfirst($record->status) }}
                    </span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Serial Number:</div>
                <div class="detail-value">{{ $record->no_serial }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Inventory Number:</div>
                <div class="detail-value">{{ $record->no_inventaris }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Note:</div>
                <div class="detail-value">{{ $record->note_record ?: 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Record Time:</div>
                <div class="detail-value">{{ $record->record_time ? $record->record_time->format('Y-m-d H:i:s') : 'N/A' }}</div>
            </div>

            <div class="actions">
                <a href="{{ route('admin.records.edit', $record->id_records) }}" class="btn">✏️ Edit Record</a>
                <form method="POST" action="{{ route('admin.records.destroy', $record->id_records) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background: #fff;" onclick="return confirm('Are you sure?')">🗑️ Delete Record</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
