<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Repair Status - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fff; min-height: 100vh; }
        .navbar { background: #fff; color: #000; padding: 0 30px;  position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; text-decoration: none; color: #000; }
        .navbar-menu { display: flex; gap: 30px; align-items: center; }
        .navbar-menu a { color: #000; text-decoration: none; font-weight: 500;  padding: 8px 16px;  }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 40px; height: 40px;  background: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 18px; overflow: hidden; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: #000; padding: 8px 20px;  cursor: pointer; font-weight: 600;  }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }
        .container { max-width: 800px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #000; }
        .btn { display: inline-block; padding: 12px 24px; background: #fff; color: #000; text-decoration: none;  font-weight: 600;  border: none; cursor: pointer; }
        .btn:hover {   }
        .btn-secondary { background: #fff; margin-left: 10px; }
        .btn-secondary:hover { background: #5a6268; }
        .card { background: white;  padding: 40px;  margin-bottom: 20px; }
        .info-grid { display: grid; grid-template-columns: 150px 1fr; gap: 15px; margin-bottom: 30px; }
        .info-label { font-weight: 600; color: #000; }
        .info-value { color: #000; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #000; font-weight: 600; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1px solid #000;  font-size: 15px;  background: #f8f9fa; }
        .form-control:focus { outline: none; border-color: #000; background: white;  }
        select.form-control { cursor: pointer; }
        .badge { display: inline-block; padding: 6px 14px;  font-size: 12px; font-weight: 600; }
        .badge-broken { background: #fff; color: #000; }
        .badge-fixing { background: #fff; color: #000; }
        .badge-good { background: #fff; color: #000; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <div class="page-header">
            <h1>Update Repair Status</h1>
            <a href="{{ route('admin.repairs.index') }}" class="btn btn-secondary">← Back</a>
        </div>
        
        <div class="card">
            <h2 style="margin-bottom: 20px; color: #000;">Repair Information</h2>
            <div class="info-grid">
                <div class="info-label">Repair ID:</div>
                <div class="info-value">#{{ $repair->id_repair }}</div>
                
                <div class="info-label">User:</div>
                <div class="info-value">{{ $repair->user ? $repair->user->name : 'N/A' }}</div>
                
                <div class="info-label">Product:</div>
                <div class="info-value">{{ $repair->record && $repair->record->product ? $repair->record->product->name : 'N/A' }}</div>
                
                <div class="info-label">Serial No:</div>
                <div class="info-value">{{ $repair->record ? $repair->record->no_serial : 'N/A' }}</div>
                
                <div class="info-label">Inventory No:</div>
                <div class="info-value">{{ $repair->record ? $repair->record->no_inventaris : 'N/A' }}</div>
                
                <div class="info-label">Current Status:</div>
                <div class="info-value">
                    <span class="badge badge-{{ $repair->record->status }}">
                        {{ ucfirst($repair->record->status) }}
                    </span>
                </div>
                
                <div class="info-label">Repair Note:</div>
                <div class="info-value">{{ $repair->note }}</div>
                
                <div class="info-label">Submitted:</div>
                <div class="info-value">{{ $repair->created_at ? \Carbon\Carbon::parse($repair->created_at)->format('d M Y H:i') : 'N/A' }}</div>
            </div>
        </div>
        
        <div class="card">
            <h2 style="margin-bottom: 20px; color: #000;">Update Status</h2>
            <form method="POST" action="{{ route('admin.repairs.update', $repair->id_repair) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="status">Item Status *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="broken" {{ $repair->record->status === 'broken' ? 'selected' : '' }}>Broken (Waiting to Start)</option>
                        <option value="fixing" {{ $repair->record->status === 'fixing' ? 'selected' : '' }}>Fixing (In Progress)</option>
                        <option value="good" {{ $repair->record->status === 'good' ? 'selected' : '' }}>Good (Completed)</option>
                    </select>
                    <small style="color: #000; font-size: 13px; display: block; margin-top: 5px;">
                        Change status to "Fixing" when you start the repair, and "Good" when completed.
                    </small>
                </div>
                
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn">Update Status</button>
                    <a href="{{ route('admin.repairs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
