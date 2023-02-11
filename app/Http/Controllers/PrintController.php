<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function ViewInvoice($id)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->leftJoin('customers', 'users.id', '=', 'customers.cust_id')
            ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->leftJoin('products', 'order_detail.prod_id', '=', 'products.prod_id')
            ->leftJoin('bales', 'bales.bale_id', '=', 'products.bale_id')
            ->leftJoin('categories', 'categories.category_id', 'bales.category_id')
            ->where('orders.order_id', '=', $id)
            ->get();

        $order = $orders->first();

        $staff = DB::table('orders')
            ->select('*')
            ->join('users', 'orders.staff_id', '=', 'users.id')
            ->where('order_id', '=', $id)
            ->get()->first();

        if ($order == null) {
            $orders = DB::table('orders')
                ->select('*', 'users.name')
                ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
                ->get();
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Order does not exist',
                    'error_msg' => 'Sorry! There are no such order placed on the system.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $carts = DB::table('order_detail')
            ->select('*')
            ->where('order_id', '=', $id)
            ->join('products', 'products.prod_id', '=', 'order_detail.prod_id')
            ->get();

        $datetime = Carbon::now();

        return view('invoice.generate-invoice', [
            'orders' => $orders,
            'order' => $order,
            'i' => 1,
            'staff' => $staff,
            'carts' => $carts,
            'datetime' => $datetime
        ]);
    }

    public function GenerateInvoice($id)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->leftJoin('customers', 'users.id', '=', 'customers.cust_id')
            ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->leftJoin('products', 'order_detail.prod_id', '=', 'products.prod_id')
            ->leftJoin('bales', 'bales.bale_id', '=', 'products.bale_id')
            ->leftJoin('categories', 'categories.category_id', 'bales.category_id')
            ->where('orders.order_id', '=', $id)
            ->get();

        $order = $orders->first();

        $staff = DB::table('orders')
            ->select('*')
            ->join('users', 'orders.staff_id', '=', 'users.id')
            ->where('order_id', '=', $id)
            ->get()->first();

        if ($order == null) {
            $orders = DB::table('orders')
                ->select('*', 'users.name')
                ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
                ->get();
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Order does not exist',
                    'error_msg' => 'Sorry! There are no such order placed on the system.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $carts = DB::table('order_detail')
            ->select('*')
            ->where('order_id', '=', $id)
            ->join('products', 'products.prod_id', '=', 'order_detail.prod_id')
            ->get();

        $datetime = Carbon::now();

        $data = [
            'orders' => $orders,
            'order' => $order,
            'i' => 1,
            'staff' => $staff,
            'carts' => $carts,
            'datetime' => $datetime
        ];

        $pdf = Pdf::loadView('invoice.generate-invoice', $data);
        return $pdf->download('invoice-id' . $order->order_id . '-' . $datetime . '.pdf');
    }

    public function Receipt($id)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->leftJoin('customers', 'users.id', '=', 'customers.cust_id')
            ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->leftJoin('products', 'order_detail.prod_id', '=', 'products.prod_id')
            ->leftJoin('bales', 'bales.bale_id', '=', 'products.bale_id')
            ->leftJoin('categories', 'categories.category_id', 'bales.category_id')
            ->where('orders.order_id', '=', $id)
            ->get();

        $order = $orders->first();
        if ($order->payment_status <> "Received") {
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Payment not yet received.',
                    'error_msg' => 'Sorry! Cannot retrieve receipt for unplaced order.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $staff = DB::table('orders')
            ->select('*')
            ->join('users', 'orders.staff_id', '=', 'users.id')
            ->where('order_id', '=', $id)
            ->get()->first();

        if ($order == null) {
            $orders = DB::table('orders')
                ->select('*', 'users.name')
                ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
                ->get();
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Order does not exist',
                    'error_msg' => 'Sorry! There are no such order placed on the system.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $carts = DB::table('order_detail')
            ->select('*')
            ->where('order_id', '=', $id)
            ->join('products', 'products.prod_id', '=', 'order_detail.prod_id')
            ->get();

        return view('receipts.generate-receipt', [
            'orders' => $orders,
            'order' => $order,
            'carts' => $carts,
            'staff' => $staff,
            'i' => 1,
            'datetime' => Carbon::now()
            // 'prod_total' => $products->count(),
        ]);
    }

    public function GenerateReceipt($id)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->leftJoin('customers', 'users.id', '=', 'customers.cust_id')
            ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->leftJoin('products', 'order_detail.prod_id', '=', 'products.prod_id')
            ->leftJoin('bales', 'bales.bale_id', '=', 'products.bale_id')
            ->leftJoin('categories', 'categories.category_id', 'bales.category_id')
            ->where('orders.order_id', '=', $id)
            ->get();

        $order = $orders->first();

        $staff = DB::table('orders')
            ->select('*')
            ->join('users', 'orders.staff_id', '=', 'users.id')
            ->where('order_id', '=', $id)
            ->get()->first();

        if ($order == null) {
            $orders = DB::table('orders')
                ->select('*', 'users.name')
                ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
                ->get();
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Order does not exist',
                    'error_msg' => 'Sorry! There are no such order placed on the system.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $carts = DB::table('order_detail')
            ->select('*')
            ->where('order_id', '=', $id)
            ->join('products', 'products.prod_id', '=', 'order_detail.prod_id')
            ->get();

        $datetime = Carbon::now();

        $data = [
            'orders' => $orders,
            'order' => $order,
            'i' => 1,
            'staff' => $staff,
            'carts' => $carts,
            'datetime' => $datetime
        ];

        $pdf = Pdf::loadView('receipts.generate-receipt', $data);
        return $pdf->download('receipt-id' . $order->order_id . '-' . $datetime . '.pdf');
    }
}
