<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Price Tracker - Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --light: #f8fafc;
            --dark: #1e293b;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--dark);
            line-height: 1.6;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-lg);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            transition: all 0.3s ease;
            padding: 8px 16px !important;
            border-radius: 8px;
            margin: 0 4px;
        }

        .nav-link:hover {
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary) !important;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .header p {
            font-size: 1.1rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 24px;
            border-radius: 16px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
            color: white;
            text-decoration: none;
        }

        .btn-success {
            background: var(--success);
        }

        .btn-warning {
            background: var(--warning);
        }

        .btn-danger {
            background: var(--danger);
        }

        .btn-info {
            background: var(--info);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.8rem;
        }

        .table-responsive {
            overflow-x: auto;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .table th {
            background: var(--light);
            font-weight: 600;
            color: var(--dark);
        }

        .table tr:hover {
            background: #f8fafc;
        }

        .alert {
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 500;
            border: none;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .is-invalid {
            border-color: var(--danger);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .action-card {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark);
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            text-decoration: none;
            color: var(--dark);
        }

        .action-icon {
            font-size: 2.5rem;
            margin-bottom: 16px;
            display: block;
        }

        .action-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .action-description {
            font-size: 0.9rem;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
   <nav class="navbar custom-navbar">
    <div class="container navbar-inner">
        <a class="navbar-brand" href="{{ route('dashboard') }}">📊 Supplier Price Tracker</a>
        <div class="navbar-links">
            <a class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">📈 Dashboard</a>
            <a class="nav-link{{ request()->routeIs('suppliers.*') ? ' active' : '' }}" href="{{ route('suppliers.index') }}">🏪 Suppliers</a>
            <a class="nav-link{{ request()->routeIs('products.*') ? ' active' : '' }}" href="{{ route('products.index') }}">📦 Products</a>
            <a class="nav-link{{ request()->routeIs('price-entries.*') ? ' active' : '' }}" href="{{ route('price-entries.index') }}">💰 Price Entries</a>
        </div>
        <div class="navbar-user">
            @if (Auth::check())
                <span class="navbar-text">Welcome, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger ml-2">Logout</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>
</nav>

<style>
.custom-navbar {
    background: rgba(255,255,255,0.97);
    box-shadow: 0 4px 16px rgba(102,126,234,0.07);
    border-radius: 0 0 18px 18px;
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 100;
}
.navbar-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 10px;
    min-height: 64px;
}
.navbar-links {
    display: flex;
    gap: 8px;
}
.navbar-user {
    display: flex;
    align-items: center;
    gap: 10px;
}
.nav-link {
    font-weight: 500;
    color: var(--dark) !important;
    padding: 8px 16px;
    border-radius: 8px;
    transition: background 0.2s, color 0.2s;
    text-decoration: none;
    position: relative;
}
.nav-link.active, .nav-link:hover {
    background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
    color: #fff !important;
}
.nav-link.active::after {
    content: '';
    display: block;
    margin: 0 auto;
    width: 60%;
    height: 3px;
    border-radius: 2px;
    background: #6366f1;
    margin-top: 4px;
}
@media (max-width: 900px) {
    .navbar-inner {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .navbar-links {
        flex-wrap: wrap;
        gap: 4px;
    }
    .navbar-user {
        width: 100%;
        justify-content: flex-end;
    }
}
</style>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>