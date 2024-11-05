<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the purchases.
     */

     
    public function index()
    {
        $purchases = Purchase::with('supplier', 'purchaseItems')->get();
        return view("purchases.index", compact('purchases'));
    }

    /**
     * Show the form for creating a new purchase.
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view("purchases.create", compact('products', 'suppliers'));
    }

    /**
     * Store a newly created purchase in storage.
     */
    public function store(Request $request)
    {
        // Debugging: Check incoming data
        // dd($request->all());

        // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'product_items' => 'required|array|min:1',
            'product_items.*.product_id' => 'required|exists:products,id',
            'product_items.*.quantity' => 'required|integer|min:1',
            'product_items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Create the purchase
        $purchase = Purchase::create([
            'date' => $request->date,
            'supplier_id' => $request->supplier_id,
            'notes' => $request->notes,
        ]);

        // Create each purchase item
        foreach ($request->product_items as $item) {
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Redirect with success message
        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    public function show($id)
{
    $purchase = Purchase::with('supplier', 'purchaseItems.product')->findOrFail($id);
    return view('purchases.show', compact('purchase'));
}
}
