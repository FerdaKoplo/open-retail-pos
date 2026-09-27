<?php

namespace App\Http\Controllers\PoS;

use App\Http\Controllers\Controller;
use App\Services\DisplayProductService;
use Cache;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DisplayProductController extends Controller
{
    protected DisplayProductService $displayProductService;

    public function __construct(DisplayProductService $displayProductService)
    {
        $this->displayProductService = $displayProductService;
    }
    public function searchSuggestions(Request $request)
    {
        $suggestions = $this->displayProductService->preFilledSearch($request);

        return response()->json($suggestions);
    }
    public function index(Request $request)
    {
        $products = $this->displayProductService->getFilteredProduct($request);

        return Inertia::render('PoS/Products/Index', [
            'products' => $products
        ]);
    }

    public function addToCart(Request $request, int $product_id)
    {
        $items = $this->displayProductService->addProductToCart($request, $product_id);

        return response()->json($items);

    }
}
