<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; min-height: 100vh; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .navbar-menu { display: flex; gap: 30px; align-items: center; }
        .navbar-menu a { color: white; text-decoration: none; font-weight: 500; transition: opacity 0.3s; padding: 8px 16px; border-radius: 8px; }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 8px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .container { max-width: 1400px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #333; }
        .btn { display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s; border: none; cursor: pointer; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
        .table-container { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #666; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; }
        td { padding: 15px; border-bottom: 1px solid #f0f0f0; color: #333; }
        tr:hover { background: #f8f9fa; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-good { background: #43e97b; color: white; }
        .badge-broken { background: #f5576c; color: white; }
        .badge-not-taken { background: #4facfe; color: white; }
        .badge-pending { background: #ffd700; color: #333; }
        .badge-fixing { background: #ff9800; color: white; }
        .badge-decline { background: #999; color: white; }
        .actions { display: flex; gap: 10px; }
        .btn-sm { padding: 6px 12px; font-size: 14px; }
        .btn-edit { background: #4facfe; }
        .btn-delete { background: #f5576c; }
        .btn-view { background: #43e97b; }
        .product-image { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 2px solid #e0e0e0; }
        .default-product-image { width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 20px; }
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
            <h1>📋 Asset Records Management</h1>
            @if(auth()->user()->level === 'admin')
                <a href="{{ route('records.create') }}" class="btn">➕ Add New Record</a>
            @endif
        </div>

        @if(session('success'))
            <div style="padding: 15px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 8px; margin-bottom: 20px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="padding: 15px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 8px; margin-bottom: 20px;">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="table-container">
            @if($records->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Serial No.</th>
                            <th>Inventory No.</th>
                            <th>Note</th>
                            <th>Record Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $index => $record)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $record->user ? $record->user->name : 'N/A' }}</td>
                            <td>{{ $record->product ? $record->product->name : 'N/A' }}</td>
                            <td>
                                <span class="badge badge-{{ str_replace(' ', '-', $record->status) }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td>{{ $record->no_serial }}</td>
                            <td>{{ $record->no_inventaris }}</td>
                            <td>{{ Str::limit($record->note_record, 30) }}</td>
                            <td>{{ $record->record_time ? $record->record_time->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('records.show', $record->id_records) }}" class="btn btn-sm btn-view">View</a>
                                    @if(auth()->user()->level === 'admin')
                                        <a href="{{ route('records.edit', $record->id_records) }}" class="btn btn-sm btn-edit">Edit</a>
                                        <form method="POST" action="{{ route('records.destroy', $record->id_records) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 60px 20px; color: #999;">
                    <div style="font-size: 60px; margin-bottom: 20px;">📋</div>
                    <h3>No records found</h3>
                    <p>Start by adding your first asset record</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
