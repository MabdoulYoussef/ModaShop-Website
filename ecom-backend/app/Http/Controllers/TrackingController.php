<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Show tracking input page
     */
    public function index()
    {
        return view('tracking.index');
    }

    /**
     * Show tracking results
     */
    public function show(Request $request, $code = null)
    {
        // If code is provided via URL parameter
        if ($code) {
            $trackingCode = $code;
        } else {
            // If form submission
            $request->validate([
                'tracking_code' => 'required|string|size:8'
            ]);
            $trackingCode = $request->tracking_code;
        }

        // Find order by tracking code
        $order = Order::with(['customer', 'orderItems.product'])
            ->where('tracking_code', $trackingCode)
            ->first();

        if (!$order) {
            return redirect()->route('tracking.index')
                ->with('error', 'لم يتم العثور على طلب بهذا الرقم. يرجى التحقق من الرقم والمحاولة مرة أخرى.');
        }

        return view('tracking.show', compact('order'));
    }

    /**
     * Process tracking form submission
     */
    public function track(Request $request)
    {
        return $this->show($request);
    }
}
