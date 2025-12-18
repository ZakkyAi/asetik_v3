<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User - Asetik</title>
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
        .badge-admin { background: #ffd700; color: #333; }
        .badge-user { background: #e0e0e0; color: #666; }
        .actions { display: flex; gap: 10px; margin-top: 30px; }
        .user-photo-section { text-align: center; padding: 30px 0; border-bottom: 2px solid #f0f0f0; margin-bottom: 20px; }
        .user-photo-large { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #667eea; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); }
        .default-avatar-large { width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 60px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">🔐 Asetik</a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('users.index') }}" class="active">Users</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('records.index') }}">Records</a>
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
            <h1>👤 User Details</h1>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">← Back to List</a>
        </div>

        <div class="card">
            <div class="user-photo-section">
                @if($user->photo)
                    <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}" class="user-photo-large">
                @else
                    <div class="default-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <h2 style="margin-top: 20px; color: #333;">{{ $user->name }}</h2>
                <p style="color: #666; margin-top: 5px;">{{ $user->email }}</p>
            </div>

            <div class="detail-row">
                <div class="detail-label">Username:</div>
                <div class="detail-value">{{ $user->username }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Age:</div>
                <div class="detail-value">{{ $user->age ?? 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Division:</div>
                <div class="detail-value">{{ $user->divisi }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Badge:</div>
                <div class="detail-value">{{ $user->badge ?? 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Description:</div>
                <div class="detail-value">{{ $user->description ?? 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Level:</div>
                <div class="detail-value">
                    <span class="badge {{ $user->level === 'admin' ? 'badge-admin' : 'badge-user' }}">
                        {{ ucfirst($user->level) }}
                    </span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Created At:</div>
                <div class="detail-value">{{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Updated At:</div>
                <div class="detail-value">{{ $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</div>
            </div>


            @if(auth()->user()->level === 'admin')
                <div class="actions">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn">✏️ Edit User</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background: #f5576c;" onclick="return confirm('Are you sure you want to delete this user?')">🗑️ Delete User</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
