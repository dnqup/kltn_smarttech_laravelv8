<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use Cart;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function home() {
        
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();

        $productSale = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.id_categorie')
                    ->select('products.*', 'categories.categorie_name')
                    ->orderByRaw('price - promotion_price DESC')
                    ->where('products.status', 1)
                    ->take(5)
                    ->get();

        $productNew = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.id_categorie')
                    ->select('products.*', 'categories.categorie_name')
                    ->where('products.status', '=', 1)
                    ->orderBy('products.created_at', 'DESC')
                    ->get();     
        return view('client.home', ['listCats' => $listCats, 'productSale' => $productSale, 'productNew' => $productNew]);
    }

    public function getProduct($id) {
        
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();
        $catName = DB::table('categories')->where('id', $id)->first();

        $products = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.id_categorie')
                    ->select('products.*', 'categories.categorie_name')
                    ->where([
                        ['products.id_categorie', '=', $id],
                        ['products.status', '=', 1],
                    ])->get();
                   
        $brands = DB::table('brands')
                    ->where('status',  1)
                    ->get();

        
        return view('client.product', ['listCats' => $listCats,'catName' => $catName, 'products' => $products, 'brands' => $brands, ]);
    }

    public function getProductFilter($idCat, $idBrand) {
        
        
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();
        $catName = DB::table('categories')->where('id', $idCat)->first();
        $brandName = DB::table('brands')->where('id', $idBrand)->first();

        $products = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.id_categorie')
                    ->join('brands', 'brands.id', '=', 'products.id_brand')
                    ->select('products.*', 'categories.categorie_name', 'brands.brand_name' )
                    ->where([
                        ['products.id_categorie', '=', $idCat],
                        ['products.id_brand', '=', $idBrand],
                        ['products.status', '=', 1],
                    ])->get();
       
        $brands = DB::table('brands')
                    ->where('status',  1)
                    ->get();

        
        return view('client.productfilter', ['listCats' => $listCats,'catName' => $catName,'brandName' => $brandName, 'products' => $products, 'brands' => $brands, ]);
    }

    public function getProductDetail($id) {
        
        
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();

        $product = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.id_categorie')
                    ->join('brands', 'brands.id', '=', 'products.id_brand')
                    ->select('products.*', 'categories.categorie_name', 'brands.brand_name' )
                    ->where([
                        ['products.id', '=', $id],
                    ])->first();
        
        return view('client.productdetail', ['listCats' => $listCats, 'product' => $product, ]);
    }

    public function search(Request $request)
    {
        //
            $search = $request->search;
            $listCats = DB::table('categories')
            ->where('status', 1)
            ->get();

            $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.id_categorie')
            ->select('products.*', 'categories.categorie_name' )
            ->where([
                ['product_name', 'LIKE', '%'.$request->search.'%']
            ])
            ->get();
            
            $productCount = $products->count();
            
            return view('client.product-search', ['listCats'=> $listCats, 'products'=> $products, 'search'=> $search, 'productCount'=> $productCount, ]);
        
    }

    public function getCart()
    {
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();
        $carts = Cart::Content();
       

        $total = 0;
        foreach ($carts as $cart) {
            $total += ($cart->price) * ($cart->qty);
        }
        
        return view('client.cart', ['listCats' => $listCats, 'carts' => $carts, 'total' => $total]);
    }

    public function addCart(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->quantity)
        {
            $quantity = $request->quantity;
        }
        else{
            $quantity = 1;
        }
        
        
        $cart = [
            'id'=>$id, 
            'name'=>$product->product_name,
            'qty'=>$quantity,
            'price'=>$product->promotion_price,
            'weight'=> 0,
            'options'=>[
                'image'=>$product->image,

        ]];
        Cart::add($cart);
        
        
        return back()->with('success', 'Sản phẩm '.$product->product_name.' đã được thêm vào giỏ hàng');

    }

    public function deleteCart(Request $request, $id)
    {   
        
        Cart::remove($id);
        return back();
    }

    public function destroyCart(Request $request)
    {   
        
        Cart::destroy();
        return back();
    }

    public function updateCart(Request $request, $rowId)
    {   
        
        $productItem = Cart::get($rowId);
        
        if($request->quantity)
        {
            $quantity = $request->quantity;
        }
        
        Cart::update($rowId, $quantity);
        return back();
    }
    
    public function checkOut()
    {   
        
        $listCats = DB::table('categories')
                    ->where('status',1)->get();

        $user = Auth::user();
        
        $carts = Cart::Content();
        $total = 0;
        foreach ($carts as $cart) {
            $total += ($cart->price) * ($cart->qty);
        }
              
        
        return view('client.checkOut',compact('listCats','user','total'));
    }
    
    public function checkOutSuccess()
    {   
        
        $listCats = DB::table('categories')
                    ->where('status',1)->get();

        $user = Auth::user();
        $carts = Cart::Content();
        $total = 0;
        foreach ($carts as $cart) {
            $total += ($cart->price) * ($cart->qty);
        }
        
        $total = ($total > 1000000) ? $total : ($total + 30000);
        
        
        //luu thong tin đon hang vao csdl
        $storeOrder = DB::table('orders')->insertGetId(
            [
                'payment' => 1,
                'total' => $total,
                'id_user' => $user->id,
                'date_order' => date('Y/m/d', time()),
                'status' => 0,
                'created_at' => date('Y/m/d H:i:s', time()),
            ]
        );
        
        foreach($carts as $cart){
            $unitPrice = (($cart->price)*($cart->qty));
        
            $storeOrderdetail = DB::table('orderdetails')->insertGetId(
                [
                    'id_product' => $cart->id,
                    'id_order' => $storeOrder,
                    'quantity' => $cart->qty,
                    'unit_price' => $unitPrice,
                    'created_at' => date('Y/m/d H:i:s', time()),
                ]
            );
        }

       
        // gửi mail
        
            // $details = [
            //     'title' => 'Mail từ SmartTech',
            //     'fullname' => $user->fullname,
            //     'phone' => $user->phone,
            //     'address' => $user->address,
            //     'product' => $cart,
            //     'total' => $price,
            //     'date' => date('d/m/Y H:i:s', time())
                
            // ];
            
            // Mail::to($user->email)->send(new \App\Mail\OrderShipped($details));
   
        
        Cart::destroy();
        return view('client.checkoutSuccess',compact('listCats'));

        //gửi mail
        
    }
}
