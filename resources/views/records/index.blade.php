<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records - Asetik</title>
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
        .badge { display: inline-block; padding: 4px 12px;  font-size: 12px; font-weight: 600; }
        .badge-good { background: #fff; color: #000; }
        .badge-broken { background: #fff; color: #000; }
        .badge-not-taken { background: #fff; color: #000; }
        .badge-pending { background: #fff; color: #000; }
        .badge-fixing { background: #fff; color: #000; }
        .badge-decline { background: #999; color: #000; }
        .actions { display: flex; gap: 10px; }
        .btn-sm { padding: 6px 12px; font-size: 14px; }
        .btn-edit { background: #fff; }
        .btn-delete { background: #fff; }
        .btn-view { background: #fff; }
        .product-image { width: 50px; height: 50px; object-fit: cover;  border: 1px solid #000; }
        .default-product-image { width: 50px; height: 50px;  background: #fff; color: #000; display: inline-flex; align-items: center; justify-content: center; font-size: 20px; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <div class="page-header">
            <h1>Asset Records Management</h1>
            @if(auth()->user()->level === 'admin')
                <a href="{{ route('admin.records.create') }}" class="btn">Add New Record</a>
            @endif
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
                                    <a href="{{ route('admin.records.show', $record->id_records) }}" class="btn btn-sm btn-view">View</a>
                                    @if(auth()->user()->level === 'admin')
                                        <a href="{{ route('admin.records.edit', $record->id_records) }}" class="btn btn-sm btn-edit">Edit</a>
                                        <form method="POST" action="{{ route('admin.records.destroy', $record->id_records) }}" style="display: inline;">
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
                <div style="text-align: center; padding: 60px 20px; color: #000;">
                    <div style="font-size: 60px; margin-bottom: 20px;"></div>
                    <h3>No records found</h3>
                    <p>Start by adding your first asset record</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
