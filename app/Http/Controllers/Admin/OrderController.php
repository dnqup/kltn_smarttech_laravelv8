<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $orders = DB::table('orders')
            ->join('users','orders.id_user','=','users.id')
            ->select('orders.*', 'users.name','users.phone','users.address')
            ->orderBy('orders.created_at', 'DESC')
            ->simplePaginate(5);
        
        return view('admin.order.list', ['orders' => $orders,]);
    }

    public function show($id) {
        $idOrder = $id;
        $orD = DB::table('orders')
                ->where('id',$id)->first();
        
        $proDetail = DB::table('orderdetails')
                    ->leftJoin('products', 'products.id', '=', 'orderdetails.id_product')
                    ->simplePaginate(5);
        
    	return view('admin.order.listdetail',compact('idOrder','orD','proDetail'));
    }

    public function checkOrder($id) {
        $checkOrd = DB::table('orders')
                ->where('id',$id)
                ->update(['status' => 1]);
        return back()->with('success','Xác nhận đơn hàng "'.$id.'" thành công');
    }

    public function destroy(Request $request,$id)
    {

        $deleteOrd = DB::table('orders')->where('id', $id)
                ->delete();
        $deleteOrdetail = DB::table('orderdetails')->where('id_order', $id)
                ->delete();

        
        return back()->with('success','Hủy đơn hàng "'.$id.'" thành công');
    }

    
}   
