<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Asetik</title>
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
        .container { max-width: 600px; margin: 0 auto; padding: 30px; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #333; }
        .btn { display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none;  font-weight: 600; transition: all 0.3s; border: none; cursor: pointer; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
        .btn-secondary { background: #6c757d; margin-left: 10px; }
        .btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }
        .card { background: white;  padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 600; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e0e0e0;  font-size: 15px; transition: all 0.3s ease; background: #f8f9fa; }
        .form-control:focus { outline: none; border-color: #667eea; background: white; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .error-message { color: #e74c3c; font-size: 13px; margin-top: 6px; display: block; }
        .alert { padding: 15px;  margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <div class="page-header">
            <h1>Change Password</h1>
        </div>
        
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('user.profile.update-password') }}">
                @csrf
                
                <div class="form-group">
                    <label for="current_password">Current Password *</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                    @error('current_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="new_password">New Password *</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                    <small style="color: #666; font-size: 13px;">Minimum 6 characters</small>
                    @error('new_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password *</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                </div>
                
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn">Change Password</button>
                    <a href="{{ route('user.profile') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
