<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .navbar { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white; padding: 0 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; color: white; text-decoration: none; }
        .navbar-menu { display: flex; gap: 30px; }
        .navbar-menu a { color: white; text-decoration: none; font-weight: 500; padding: 8px 16px; border-radius: 8px; transition: all 0.3s; }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; color: white; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 8px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }
        .container { max-width: 1400px; margin: 0 auto; padding: 40px 30px; }
        .welcome-section { text-align: center; color: white; margin-bottom: 50px; }
        .welcome-section h1 { font-size: 48px; margin-bottom: 10px; font-weight: 700; }
        .welcome-section p { font-size: 20px; opacity: 0.9; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 40px; }
        .stat-card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); transition: all 0.3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3); }
        .stat-value { font-size: 48px; font-weight: 700; margin-bottom: 10px; }
        .stat-label { font-size: 16px; color: #666; text-transform: uppercase; letter-spacing: 1px; }
        .stat-card.users .stat-value { color: #667eea; }
        .stat-card.products .stat-value { color: #f093fb; }
        .stat-card.records .stat-value { color: #4facfe; }
        .stat-card.repairs .stat-value { color: #43e97b; }
        .info-box { background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 30px; margin-top: 30px; }
        .info-box h2 { color: #667eea; margin-bottom: 15px; }
        .info-box p { color: #666; line-height: 1.6; margin-bottom: 10px; }
        .badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; background: #ffd700; color: #333; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">🔐 Asetik</a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
                <a href="{{ route('users.index') }}">Users</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('records.index') }}">Records</a>
                <a href="{{ route('repairs.index') }}">Repairs</a>
            </div>
            <div class="user-info">
                <span class="badge">Normal User</span>
                <strong>{{ auth()->user()->name }}</strong>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-section">
            <h1>Welcome, {{ auth()->user()->name }}! 👋</h1>
            <p>View IT assets and equipment information</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card users">
                <div class="stat-value">{{ \App\Models\User::count() }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card products">
                <div class="stat-value">{{ \App\Models\Product::count() }}</div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card records">
                <div class="stat-value">{{ \App\Models\Record::count() }}</div>
                <div class="stat-label">Asset Records</div>
            </div>
            <div class="stat-card repairs">
                <div class="stat-value">{{ \App\Models\Repair::count() }}</div>
                <div class="stat-label">Repair Requests</div>
            </div>
        </div>

        <div class="info-box">
            <h2>📋 Your Access Level: Normal User</h2>
            <p><strong>✅ You can:</strong></p>
            <p>• View all users, products, records, and repairs</p>
            <p>• See detailed information about each item</p>
            <p>• Browse through all asset records</p>
            <p></p>
            <p><strong>❌ You cannot:</strong></p>
            <p>• Create new users, products, records, or repairs</p>
            <p>• Edit existing information</p>
            <p>• Delete any data</p>
            <p></p>
            <p style="margin-top: 15px; color: #667eea;"><strong>💡 Tip:</strong> If you need to make changes, please contact your administrator.</p>
        </div>
    </div>
</body>
</html>
