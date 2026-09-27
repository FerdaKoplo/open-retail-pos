<?php

namespace App\Services;

use App\Models\InventoryStock;
use App\Models\Product;
use Illuminate\Http\Request;

class DisplayProductService
{
    public function preFilledSearch(Request $request)
    {
        $search = $request->query('q');

        return Product::query()->where('name', 'like', "%{$search}%")
            ->limit(5)
            ->get(['id', 'name']);
    }
    public function getFilteredProduct(Request $request)
    {
        $query = Product::query()
            ->with(['category', 'taxRate', 'barcodes'])
            ->where('is_active', true);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('barcodes', function ($subQ) use ($search) {
                        $subQ->where('barcode', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('category')) {
            $category = $request->category;

            if (strtolower($category) !== 'all products') {
                if (is_numeric($category)) {
                    $query->where('category_id', $category);
                } else {
                    $query->whereHas('category', function ($q) use ($category) {
                        $q->where('name', $category);
                    });
                }
            }
        }

        return $query->paginate(12);
    }


    public function addProductToCart(Request $request, int $product_id)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'quantity' => 'required|numeric|min:0.1',
        ]);


        $quantity = $request->input('quantity');
        $locationId = $request->input('location_id');

        $product = Product::with('taxRate')->findOrFail($product_id);

        if ($product->track_stock) {
            $stock = InventoryStock::where('product_id', $product_id)
                ->where('location_id', $locationId)->first();

            $avaliableQuantity = $stock ? $stock->quantity : 0;
            if ($avaliableQuantity < $quantity) {
                return response()->json([
                    'message' => 'Insufficient Stock',
                    'avaliable_stock' => $avaliableQuantity
                ], 422);
            }

        }

        // calculate base price

        $basePrice = $product->selling_price;
        $taxRate = $product->taxRate ? ($product->taxRate->rate / 100) : 0;

        $netPrice = $basePrice;
        $taxAmount = 0;

        if ($product->taxRate && $product->taxRate->is_active) {
            if ($product->taxRate->is_inclusive) {
                $netPrice = $basePrice / (1 + $taxRate);
                $taxAmount = $basePrice - $netPrice;
            } else {
                $netPrice = $basePrice;
                $taxAmount = $basePrice * $taxRate;
            }

        }

        $unitPriceGross = $netPrice + $taxAmount;
        $lineTotal = $unitPriceGross * $quantity;

        return response()->json([
            'success' => true,
            'cart_item' => [
                'product_id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'quantity' => (float) $quantity,
                'unit_price_net' => round($netPrice, 2),
                'tax_amount' => round($taxAmount * $quantity, 2),
                'unit_price_gross' => round($unitPriceGross, 2),
                'line_total' => round($lineTotal, 2),
                'is_inclusive' => $product->taxRate->is_inclusive ?? false,
            ]
        ]);


    }


    // public function removeProductFromCart(Request $request)
    // {

    // }
}