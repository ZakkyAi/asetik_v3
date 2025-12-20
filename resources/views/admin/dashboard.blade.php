<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content-width, initial-scale=1.0">
    <title>Dashboard - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #fff; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { font-size: 24px; color: #000; margin-bottom: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .stat-card { background: #fff; border: 1px solid #000; padding: 20px; }
        .stat-label { font-size: 14px; color: #000; margin-bottom: 5px; }
        .stat-value { font-size: 28px; color: #000; font-weight: bold; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ \App\Models\User::count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Products</div>
                <div class="stat-value">{{ \App\Models\Product::count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Records</div>
                <div class="stat-value">{{ \App\Models\Record::count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Repairs</div>
                <div class="stat-value">{{ \App\Models\Repair::count() }}</div>
            </div>
        </div>
    </div>
</body>
</html>
