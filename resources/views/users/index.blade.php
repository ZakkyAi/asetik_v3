<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Asetik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff;
            min-height: 100vh;
        }

        .navbar {
            background: #fff;
            color: #000;
            padding: 0 30px;
            
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #000;
        }

        .navbar-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .navbar-menu a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
            
            padding: 8px 16px;
            
        }

        .navbar-menu a:hover, .navbar-menu a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #000;
            padding: 8px 20px;
            
            cursor: pointer;
            font-weight: 600;
            
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 32px;
            color: #000;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #fff;
            color: #000;
            text-decoration: none;
            
            font-weight: 600;
            
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            
            
        }

        .table-container {
            background: white;
            
            padding: 30px;
            
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #000;
            text-
            font-size: 12px;
            letter-spacing: 1px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #000;
            color: #000;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            
            font-size: 12px;
            font-weight: 600;
        }

        .badge-admin {
            background: #fff;
            color: #000;
        }

        .badge-user {
            background: #e0e0e0;
            color: #000;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 14px;
        }

        .btn-edit {
            background: #fff;
        }

        .btn-delete {
            background: #fff;
        }

        .btn-view {
            background: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #000;
        }

        .empty-state-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            
            object-fit: cover;
            border: 1px solid #000;
        }

        .default-avatar {
            width: 40px;
            height: 40px;
            
            background: #fff;
            color: #000;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
        }

        .user-info-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <div class="page-header">
            <h1>Users Management</h1>
            @if(auth()->user()->level === 'admin')
                <a href="{{ route('admin.users.create') }}" class="btn">Add New User</a>
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
            @if($users->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Division</th>
                            <th>Badge</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($user->photo)
                                    <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}" class="user-avatar">
                                @else
                                    <div class="default-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->divisi }}</td>
                            <td>{{ $user->badge }}</td>
                            <td>
                                <span class="badge {{ $user->level === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                    {{ ucfirst($user->level) }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-view">View</a>
                                    @if(auth()->user()->level === 'admin')
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-edit">Edit</a>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display: inline;">
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
                <div class="empty-state">
                    <div class="empty-state-icon"></div>
                    <h3>No users found</h3>
                    <p>Start by adding your first user</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
