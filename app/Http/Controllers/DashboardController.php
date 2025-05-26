<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function priceComparisonChartData()
    {
        // Get latest price per supplier per product
        $latestPrices = DB::table('price_entries as pe1')
            ->select('pe1.product_id', 'p.name as product_name', 'pe1.supplier_id', 's.name as supplier_name', 'pe1.price', 'pe1.date')
            ->join('products as p', 'pe1.product_id', '=', 'p.id')
            ->join('suppliers as s', 'pe1.supplier_id', '=', 's.id')
            ->whereRaw('pe1.date = (select max(pe2.date) from price_entries as pe2 where pe2.product_id = pe1.product_id and pe2.supplier_id = pe1.supplier_id)')
            ->orderBy('pe1.product_id')
            ->orderBy('pe1.supplier_id')
            ->get();

        // Group by product
        $grouped = $latestPrices->groupBy('product_name');

        return response()->json($grouped);
    }
}
