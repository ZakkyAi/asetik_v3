<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record - Asetik</title>
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
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 600; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s ease; background: #f8f9fa; }
        .form-control:focus { outline: none; border-color: #667eea; background: white; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .error-message { color: #e74c3c; font-size: 13px; margin-top: 6px; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        select.form-control { cursor: pointer; }
        textarea.form-control { min-height: 100px; resize: vertical; }
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
            <h1>✏️ Edit Record</h1>
            <a href="{{ route('records.index') }}" class="btn btn-secondary">← Back</a>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('records.update', $record->id_records) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_users">User *</label>
                    <select id="id_users" name="id_users" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_users', $record->id_users) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->username }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_users')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="id_products">Product *</label>
                    <select id="id_products" name="id_products" class="form-control" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('id_products', $record->id_products) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_products')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="good" {{ old('status', $record->status) == 'good' ? 'selected' : '' }}>Good</option>
                        <option value="broken" {{ old('status', $record->status) == 'broken' ? 'selected' : '' }}>Broken</option>
                        <option value="not taken" {{ old('status', $record->status) == 'not taken' ? 'selected' : '' }}>Not Taken</option>
                        <option value="pending" {{ old('status', $record->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="fixing" {{ old('status', $record->status) == 'fixing' ? 'selected' : '' }}>Fixing</option>
                        <option value="decline" {{ old('status', $record->status) == 'decline' ? 'selected' : '' }}>Decline</option>
                    </select>
                    @error('status')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="no_serial">Serial Number *</label>
                    <input type="text" id="no_serial" name="no_serial" class="form-control" value="{{ old('no_serial', $record->no_serial) }}" required>
                    @error('no_serial')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="no_inventaris">Inventory Number *</label>
                    <input type="text" id="no_inventaris" name="no_inventaris" class="form-control" value="{{ old('no_inventaris', $record->no_inventaris) }}" required>
                    @error('no_inventaris')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="note_record">Note</label>
                    <textarea id="note_record" name="note_record" class="form-control">{{ old('note_record', $record->note_record) }}</textarea>
                    @error('note_record')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">💾 Update Record</button>
                    <a href="{{ route('records.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
