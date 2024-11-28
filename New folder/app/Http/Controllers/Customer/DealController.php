<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ShipmentInfo;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function confirmation(int $id)
    {
        $deal = Deal::find($id);
        return view('customer.confirmation', compact('deal'));
    }
    public function cart()
    {
        $customer = Auth::guard('customer')->user();
        $cart = session()->get('cart', []);
        $shippingInfo = $customer->shipmentInfo()->first();

        $total = 100; // Shipping cost
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('customer.cart', compact('cart', 'total', 'shippingInfo'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        $cart = session()->get('cart', []);

        // If the product exists in the cart, increase the quantity
        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity'] += $request->quantity;
        } else {
            // If it doesn't exist, add it with the specified quantity
            $cart[$product->product_id] = [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image_path' => $product->image_path
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('customer.cart')->with('successfully', 'Product added to cart successfully!');
    }

    public function updateShippingInfo(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|numeric',
            'country' => 'required|string|max:100',
            'phone' => 'required|numeric|digits:10',
        ]);
        $shipmentInfo = ShipmentInfo::where('customer_id', $customer->customer_id)->first();
        if (!$shipmentInfo) {
            ShipmentInfo::create([
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'phone' => $request->phone,
                'customer_id' => $customer->customer_id,
            ]);
        } else {
            $shipmentInfo->update($request->only('address', 'city', 'state', 'postal_code', 'country', 'phone'));
        }
        return back()->with('successfully', 'Shipping information updated successfully.');
    }

    public function placeOrder(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = 100; // Shipping cost
        $productId = null;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $productId= $item['product_id'];
        }

        $pro = Product::find($productId);
        $supplier = Supplier::find($pro->seller_id);
        if (!$supplier) {
            return back()->with('error', 'The seller associated with the product does not exist.');
        }
        // Create a new deal
        $deal = Deal::create([
            'customer_id' => $customer->customer_id,
            'admin_id' => 1,
            'seller_id' => $supplier->seller_id,
            'deal_date' => now(),
            'total_price' => $total,
            'deal_status' => 'pending',
        ]);

        // Add deal items
        foreach ($cart as $item) {
            $itemPro = Product::find($item['product_id']);
            if ($itemPro) {
                $itemPro->update([
                    'stock_quantity' => $itemPro->stock_quantity - $item['quantity']
                ]);
            }
            DealItem::create([
                'deal_id' => $deal->deal_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Store payment information
        $paymentMethod = $request->query('payment_method');
        Payment::create([
            'deal_id' => $deal->deal_id,
            'payment_date' => now(),
            'payment_method' => $paymentMethod,
            'amount' => $total,
            'payment_status' => 'completed', // Set appropriate payment status
        ]);

        // Clear the cart
        session()->forget('cart');
        return redirect()->route('customer.confirmation',['dealId' => $deal->deal_id])->with('successfully', 'Order placed successfully!');
//        return redirect()->route('customer.dealSummary', $deal->deal_id)->with('successfully', 'Order placed successfully!');
    }


    public function dealSummary($dealId)
    {
        $deal = Deal::with('dealItems.product')->where('customer_id', auth('customer')->user()->customer_id
        )->findOrFail($dealId);
        $shippingInfo = auth('customer')->user()->shipmentInfo;

        return view('customer.dealSummary', compact('deal', 'shippingInfo'));
    }


    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Remove the item from the cart
            session()->put('cart', $cart); // Update the cart session
        }
        return redirect()->route('customer.cart')->with('successfully', 'Product removed from cart successfully!');
    }

    public function trackOrder(Request $request)
    {
        $orderNumber = $request->input('order_number');
        $customerId = auth('customer')->user()->customer_id;

        // Fetch the order based on deal_id and the authenticated customer's ID
        $order = Deal::where('deal_id', $orderNumber)
            ->where('customer_id', $customerId)
            ->first();

        return view('customer.track_order', compact('order'));
    }

}
