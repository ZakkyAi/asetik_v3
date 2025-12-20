<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fff; min-height: 100vh; }
        .navbar { background: #fff; color: #000; padding: 0 30px;  position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; text-decoration: none; color: #000; }
        .navbar-menu { display: flex; gap: 30px; align-items: center; }
        .navbar-menu a { color: #000; text-decoration: none; font-weight: 500; padding: 8px 16px;  }
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
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #000; font-weight: 600; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1px solid #000;  font-size: 15px;  background: #f8f9fa; }
        .form-control:focus { outline: none; border-color: #000; background: white;  }
        .form-control.error { border-color: #e74c3c; background: #fff5f5; }
        .error-message { color: #e74c3c; font-size: 13px; margin-top: 6px; display: block; }
        .alert { padding: 12px 16px;  margin-bottom: 20px; font-size: 14px; }
        .alert-danger { background: #fee; color: #c33; border: 1px solid #000; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        select.form-control { cursor: pointer; }
        textarea.form-control { min-height: 100px; resize: vertical; }
        .photo-preview { margin-top: 15px; max-width: 200px;  border: 1px solid #000; display: none; }
        .photo-upload-label { display: inline-block; padding: 10px 20px; background: #fff; color: #000;  cursor: pointer;  }
        .photo-upload-label:hover { background: #5568d3;  }
        #photo { display: none; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">Asetik</a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="active">Users</a>
                <a href="{{ route('admin.products.index') }}">Products</a>
                <a href="{{ route('admin.records.index') }}">Records</a>
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
            <h1>Add New User</h1>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">← Back to List</a>
        </div>

        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul style="margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="photo">Profile Photo</label>
                    <label for="photo" class="photo-upload-label">Choose Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                    <img id="photoPreview" class="photo-preview" alt="Photo preview">
                    <small style="display: block; margin-top: 8px; color: #000;">Max size: 2MB. Formats: JPG, PNG, GIF</small>
                    @error('photo')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') error @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" class="form-control @error('username') error @enderror" value="{{ old('username') }}" required>
                    @error('username')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') error @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') error @enderror" required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" class="form-control @error('age') error @enderror" value="{{ old('age') }}">
                    @error('age')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="divisi">Division *</label>
                    <input type="text" id="divisi" name="divisi" class="form-control @error('divisi') error @enderror" value="{{ old('divisi') }}" required>
                    @error('divisi')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="badge">Badge</label>
                    <input type="text" id="badge" name="badge" class="form-control @error('badge') error @enderror" value="{{ old('badge') }}">
                    @error('badge')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control @error('description') error @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="level">Level *</label>
                    <select id="level" name="level" class="form-control @error('level') error @enderror" required>
                        <option value="normal_user" {{ old('level') == 'normal_user' ? 'selected' : '' }}>Normal User</option>
                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('level')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Create User</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewPhoto(event) {
            const preview = document.getElementById('photoPreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
