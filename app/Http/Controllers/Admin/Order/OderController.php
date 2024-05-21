<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;

class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(orders $orders)
    {
        $orders = orders::all();
        return view('Admin.Order.index', compact('orders'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, orders $orders)
    {
        $orders = orders::where('id', $id)->first();
        // dd($orders);
        $orderStatuses = [
            0 => 'Chờ xác nhận',
            1 => 'Đã xác nhận',
            2 => 'Đang vận chuyển',
            3 => 'Đã giao hàng',
            4 => 'Đã hủy',
        ];
        return view('Admin.Order.edit', compact('orders', 'orderStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $orders = orders::where('id', $id)->first();
        $orders->status=$request->status;
        $orders->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
