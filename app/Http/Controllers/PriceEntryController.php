<?php
namespace App\Http\Controllers;

use App\Models\PriceEntry;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PriceEntryController extends Controller
{
    public function index()
    {
        $priceEntries = PriceEntry::with(['product', 'supplier'])->get();
        return view('price-entries.index', compact('priceEntries'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('price-entries.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        PriceEntry::create($request->all());
        return redirect()->route('price-entries.index')->with('success', 'Price entry added successfully!');
    }

    public function edit(PriceEntry $priceEntry)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('price-entries.edit', compact('priceEntry', 'products', 'suppliers'));
    }

    public function update(Request $request, PriceEntry $priceEntry)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $priceEntry->update($request->all());
        return redirect()->route('price-entries.index')->with('success', 'Price entry updated successfully!');
    }

    public function destroy(PriceEntry $priceEntry)
    {
        $priceEntry->delete();
        return redirect()->route('price-entries.index')->with('success', 'Price entry deleted successfully!');
    }

    public function compare(Request $request)
    {
        $products = Product::all();
        $productId = $request->input('product_id');

        $comparisonData = [];
        if ($productId) {
            $comparisonData = PriceEntry::with('supplier')
                ->where('product_id', $productId)
                ->orderBy('date', 'desc')
                ->get()
                ->groupBy('supplier.name');
        }

        return view('price-entries.compare', compact('products', 'comparisonData', 'productId'));
    }
}
