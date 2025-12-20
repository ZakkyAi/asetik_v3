<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Asetik</title>
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
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #333; }
        .btn { display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none;  font-weight: 600; transition: all 0.3s; border: none; cursor: pointer; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
        .card { background: white;  padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 30px; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px; }
        .info-item { padding: 15px; background: #f8f9fa;  }
        .info-label { font-size: 12px; color: #666; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .info-value { font-size: 16px; color: #333; font-weight: 600; }
        .user-photo { width: 120px; height: 120px;  object-fit: cover; border: 4px solid #667eea; margin-bottom: 20px; }
        .default-avatar { width: 120px; height: 120px;  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: bold; margin-bottom: 20px; }
        .table-container { background: white;  padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #666; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; }
        td { padding: 15px; border-bottom: 1px solid #f0f0f0; color: #333; }
        tr:hover { background: #f8f9fa; }
        .badge { display: inline-block; padding: 4px 12px;  font-size: 12px; font-weight: 600; }
        .badge-good { background: #43e97b; color: white; }
        .badge-broken { background: #f5576c; color: white; }
        .badge-pending { background: #ffd700; color: #333; }
        .badge-fixing { background: #ff9800; color: white; }
        .badge-not-taken { background: #4facfe; color: white; }
        .badge-decline { background: #999; color: white; }
        .badge-admin { background: #ffd700; color: #333; }
        .badge-user { background: #e0e0e0; color: #666; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <div class="page-header">
            <h1>My Profile</h1>
            <a href="{{ route('user.profile.change-password') }}" class="btn">Change Password</a>
        </div>
        
        <div class="card">
            <div style="text-align: center;">
                @if($user->photo)
                    <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}" class="user-photo">
                @else
                    <div class="default-avatar" style="margin: 0 auto;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Name</div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Username</div>
                    <div class="info-value">{{ $user->username }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Age</div>
                    <div class="info-value">{{ $user->age }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Division</div>
                    <div class="info-value">{{ $user->divisi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Badge</div>
                    <div class="info-value">{{ $user->badge }}</div>
                </div>
            </div>
            
            @if($user->description)
            <div class="info-item">
                <div class="info-label">Description</div>
                <div class="info-value">{{ $user->description }}</div>
            </div>
            @endif
        </div>
        
        <h2 style="font-size: 24px; color: #333; margin-bottom: 20px;">My Items</h2>
        
        <div class="table-container">
            @if($records->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Serial No</th>
                            <th>Inventory No</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Record Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $index => $record)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $record->product ? $record->product->name : 'N/A' }}</td>
                            <td>{{ $record->no_serial }}</td>
                            <td>{{ $record->no_inventaris }}</td>
                            <td>
                                <span class="badge badge-{{ str_replace(' ', '-', $record->status) }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td>{{ $record->note_record }}</td>
                            <td>{{ $record->record_time ? $record->record_time->format('Y-m-d H:i') : 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 60px 20px; color: #999;">
                    <h3>No items assigned</h3>
                    <p>You don't have any items assigned to you yet.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
