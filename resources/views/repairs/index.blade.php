<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repairs - Asetik</title>
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
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: #000; padding: 8px 20px;  cursor: pointer; font-weight: 600;  }
        .container { max-width: 1400px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #000; }
        .btn { display: inline-block; padding: 12px 24px; background: #fff; color: #000; text-decoration: none;  font-weight: 600;  border: none; cursor: pointer; }
        .btn:hover {   }
        .table-container { background: white;  padding: 30px;  overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #000; text- font-size: 12px; letter-spacing: 1px; }
        td { padding: 15px; border-bottom: 1px solid #000; color: #000; }
        tr:hover { background: #f8f9fa; }
        .actions { display: flex; gap: 10px; }
        .btn-sm { padding: 6px 12px; font-size: 14px; }
        .btn-edit { background: #fff; }
        .btn-delete { background: #fff; }
        .btn-view { background: #fff; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <div class="page-header">
            <h1>Approve Repairs</h1>
        </div>

        @if(session('success'))
            <div style="padding: 15px; background: #d4edda; color: #155724; border: 1px solid #000;  margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="padding: 15px; background: #f8d7da; color: #721c24; border: 1px solid #000;  margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-container">
            @if($repairs->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Serial No</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($repairs as $repair)
                        <tr>
                            <td>{{ $repair->id_repair }}</td>
                            <td>{{ $repair->user ? $repair->user->name : 'N/A' }}</td>
                            <td>{{ $repair->record && $repair->record->product ? $repair->record->product->name : 'N/A' }}</td>
                            <td>{{ $repair->record ? $repair->record->no_serial : 'N/A' }}</td>
                            <td>
                                @if($repair->record)
                                    @if($repair->record->status === 'broken')
                                        <span class="badge" style="background: #fff; color: #000;">Waiting Approval</span>
                                    @elseif($repair->record->status === 'fixing')
                                        <span class="badge" style="background: #fff; color: #000;">Repairing</span>
                                    @elseif($repair->record->status === 'good')
                                        <span class="badge" style="background: #fff; color: #000;">Completed</span>
                                    @endif
                                @else
                                    <span class="badge" style="background: #999; color: #000;">N/A</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($repair->note, 50) }}</td>
                            <td>{{ $repair->created_at ? \Carbon\Carbon::parse($repair->created_at)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.repairs.show', $repair->id_repair) }}" class="btn btn-sm btn-view">View</a>
                                    
                                    @if(auth()->user()->level === 'admin')
                                        @if($repair->record && $repair->record->status === 'broken')
                                            <!-- Waiting for approval - show Accept/Decline -->
                                            <form method="POST" action="{{ route('admin.repairs.accept', $repair->id_repair) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm" style="background: #fff; color: #000;">Accept</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.repairs.decline', $repair->id_repair) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm" style="background: #fff; color: #000;" onclick="return confirm('Are you sure you want to decline this repair request?')">Decline</button>
                                            </form>
                                        @elseif($repair->record && $repair->record->status === 'fixing')
                                            <!-- Repairing - show Done button -->
                                            <form method="POST" action="{{ route('admin.repairs.done', $repair->id_repair) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm" style="background: #fff; color: #000;">Done</button>
                                            </form>
                                        @elseif($repair->record && $repair->record->status === 'good')
                                            <!-- Completed - show delete option -->
                                            <form method="POST" action="{{ route('admin.repairs.destroy', $repair->id_repair) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 60px 20px; color: #000;">
                    <div style="font-size: 60px; margin-bottom: 20px;">🔧</div>
                    <h3>No repairs found</h3>
                    <p>Start by adding your first repair request</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
