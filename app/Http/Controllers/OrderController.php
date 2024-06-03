<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request): JsonResponse
    {
        // Validate request data (email is likely required)
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // Create a new order instance
        $order = new Order;
        $order->email = $validated['email'];
        // ... further logic to handle product quantities and total amount

        $order->save();

        // Associate products with the order (assuming product IDs are provided in request)
        if (isset($request->products)) {
            foreach ($request->products as $productId) {
                $product = Product::find($productId);
                if ($product) {
                    $order->products()->attach($product);
                    // ... handle product quantity and update order total amount
                }
            }
        }

        // Handle successful order placement (e.g., return order details or redirect)
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
