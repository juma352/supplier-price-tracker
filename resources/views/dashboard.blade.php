@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>📊 Supplier Price Tracker</h1>
        <p>Track and compare supplier prices to make informed purchasing decisions for your business</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Product::count() }}</div>
            <div class="stat-label">Products Tracked</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Supplier::count() }}</div>
            <div class="stat-label">Active Suppliers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\PriceEntry::count() }}</div>
            <div class="stat-label">Price Entries</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\PriceEntry::whereDate('created_at', today())->count() }}</div>
            <div class="stat-label">Today's Entries</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📊 Recent Price Trends</h3>
            <a href="{{ route('price-entries.create') }}" class="btn btn-sm">📥 Add Price Entry</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Supplier</th>
                        <th>Current Price</th>
                        <th>Date</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $recentEntries = \App\Models\PriceEntry::with(['product', 'supplier'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($recentEntries as $entry)
                        <tr>
                            <td>{{ $entry->product->name ?? 'N/A' }}</td>
                            <td>{{ $entry->supplier->name ?? 'N/A' }}</td>
                            <td>KSh {{ number_format($entry->price, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}</td>
                            <td>{{ $entry->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No price entries found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">🚀 Quick Actions</h3>
        </div>
        <div class="quick-actions">
            <a href="{{ route('suppliers.create') }}" class="action-card">
                <span class="action-icon">🏪</span>
                <div class="action-title">Add Supplier</div>
                <div class="action-description">Register a new supplier to track their prices</div>
            </a>
            <a href="{{ route('products.create') }}" class="action-card">
                <span class="action-icon">📦</span>
                <div class="action-title">Add Product</div>
                <div class="action-description">Add a new product to your tracking list</div>
            </a>
            <a href="{{ route('price-entries.create') }}" class="action-card">
                <span class="action-icon">💰</span>
                <div class="action-title">Add Price Entry</div>
                <div class="action-description">Record new price information from suppliers</div>
            </a>
            <a href="{{ route('price-entries.index') }}" class="action-card">
                <span class="action-icon">📊</span>
                <div class="action-title">View Reports</div>
                <div class="action-description">Analyze price trends and comparisons</div>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📈 Price Comparison Chart</h3>
        </div>
        <canvas id="priceComparisonChart" width="400" height="200"></canvas>
    </div>

<style>
.header {
    text-align: center;
    margin-bottom: 2rem;
}
.stats-grid {
    display: flex;
    gap: 2rem;
    justify-content: center;
    margin-bottom: 2rem;
}
.stat-card {
    background: #f8fafc;
    border-radius: 10px;
    padding: 1.5rem 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    text-align: center;
    min-width: 160px;
}
.stat-number {
    font-size: 2.2rem;
    font-weight: bold;
    color: #2563eb;
}
.stat-label {
    color: #64748b;
    margin-top: 0.5rem;
    font-size: 1rem;
}
.card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    margin-bottom: 2rem;
    padding: 1.5rem;
}
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}
.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
}
.btn {
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 0.5rem 1.2rem;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.95rem;
    transition: background 0.2s;
}
.btn:hover {
    background: #1d4ed8;
}
.table {
    width: 100%;
    border-collapse: collapse;
}
.table th, .table td {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e2e8f0;
}
.table th {
    background: #f1f5f9;
    color: #334155;
    font-weight: 600;
}
.table tr:last-child td {
    border-bottom: none;
}
.quick-actions {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    margin-top: 1rem;
    flex-wrap: wrap;
}
.action-card {
    background: #f8fafc;
    border-radius: 10px;
    padding: 1.2rem 1.5rem;
    text-align: center;
    text-decoration: none;
    color: #1e293b;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    transition: box-shadow 0.2s, background 0.2s;
    min-width: 180px;
}
.action-card:hover {
    background: #e0e7ef;
    box-shadow: 0 4px 16px rgba(37,99,235,0.08);
}
.action-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}
.action-title {
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.3rem;
}
.action-description {
    font-size: 0.95rem;
    color: #64748b;
}
@media (max-width: 900px) {
    .stats-grid, .quick-actions {
        flex-direction: column;
        align-items: center;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('dashboard.priceComparisonChartData') }}")
        .then(response => response.json())
        .then(data => {
            const labels = Object.keys(data);
            const datasets = [];

            labels.forEach(productName => {
                const suppliers = data[productName];
                Object.keys(suppliers).forEach(supplierName => {
                    const supplierData = suppliers[supplierName];
                    datasets.push({
                        label: supplierName + ' - ' + productName,
                        data: [supplierData.price],
                        fill: false,
                        borderColor: getRandomColor(),
                        tension: 0.1
                    });
                });
            });

            const ctx = document.getElementById('priceComparisonChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Supplier Price Comparison'
                        }
                    }
                }
            });

            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        });
});
</script>
@endsection
