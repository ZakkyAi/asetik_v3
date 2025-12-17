<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; min-height: 100vh; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; text-decoration: none; color: white; }
        .navbar-menu { display: flex; gap: 30px; }
        .navbar-menu a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 8px; }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 8px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; }
        .container { max-width: 900px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #333; }
        .btn { display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s; border: none; cursor: pointer; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
        .btn-secondary { background: #6c757d; }
        .card { background: white; border-radius: 15px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); }
        .detail-row { display: flex; padding: 15px 0; border-bottom: 1px solid #f0f0f0; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-weight: 600; color: #666; width: 200px; }
        .detail-value { color: #333; flex: 1; }
        .badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .badge-good { background: #43e97b; color: white; }
        .badge-broken { background: #f5576c; color: white; }
        .badge-not-taken { background: #4facfe; color: white; }
        .badge-pending { background: #ffd700; color: #333; }
        .badge-fixing { background: #ff9800; color: white; }
        .badge-decline { background: #999; color: white; }
        .actions { display: flex; gap: 10px; margin-top: 30px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">🔐 Asetik</a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('users.index') }}">Users</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('records.index') }}" class="active">Records</a>
                <a href="{{ route('repairs.index') }}">Repairs</a>
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
            <a href="{{ route('records.index') }}" class="btn btn-secondary">← Back</a>
        </div>

        <div class="card">
            <div class="detail-row">
                <div class="detail-label">Record ID:</div>
                <div class="detail-value">{{ $record->id_records }}</div>
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
                <a href="{{ route('records.edit', $record->id_records) }}" class="btn">✏️ Edit Record</a>
                <form method="POST" action="{{ route('records.destroy', $record->id_records) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background: #f5576c;" onclick="return confirm('Are you sure?')">🗑️ Delete Record</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
