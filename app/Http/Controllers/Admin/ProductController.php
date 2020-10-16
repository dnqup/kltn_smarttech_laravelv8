<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\admin\product\StoreProductRequest;
use App\Http\Requests\admin\product\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $categories = Categorie::orderBy('id','desc')->get();
        $brands = Brand::orderBy('id','desc')->get();
        $products = DB::table('products')
                        ->select('*')
                        ->simplePaginate(5);
        
        return view('admin.product.list', ['categories' => $categories, 'brands' => $brands, 'products' => $products,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['categories'] = Categorie::orderBy('id','desc')->get();
        $data['brands'] = Brand::orderBy('id','desc')->get();
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // kiểm tra status
        $isStatus = $request->input('status');
        // dd($isStatus);
        if ($isStatus === null) {
            $isStatus = 0;
        } else {
            $isStatus = 1;
        }
        
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/product_images');
            $image_name = $request->file('image')->hashName();
        }
        
        $product = DB::table('products')->insertGetId([
            'product_name'=>$request->input('product_name'),
            'image'=>$image_name,
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'promotion_price'=>$request->input('promotion_price'),
            'id_categorie'=>$request->input('id_categorie'),
            'id_brand'=>$request->input('id_brand'),
            'status' => $isStatus,
            'created_at' => date('Y/m/d H:i:s', time()),
        ]);

        return redirect()->route('product.list')
                         ->with('success','Thêm mới nhãn hiệu "'.$request->input('product_name').'" thành công');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Categorie::orderBy('id','desc')->get();
        $brands = Brand::orderBy('id','desc')->get();
        $editProduct = DB::table('products')->where('id', $id)->first();
        return view('admin.product.edit', ['editProduct' => $editProduct, 'categories' => $categories, 'brands' => $brands,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        //
        $editProduct = DB::table('products')->where('id', $id)->first();
        
        $isStatus = $request->input('status');
        if ($isStatus === null) {
            $isStatus = 0;
        } else {
            $isStatus = 1;
        }

        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/product_images');
            $image_name = $request->file('image')->hashName();

            // kiểm tra file image cũ có tồn tại và xóa
            $old_path = 'public/product_images/'.$editProduct->image;
            
            if (Storage::exists($old_path)) {
                
                Storage::delete($old_path);
            } 
        } else {
            $image_name = $editProduct->image;
        }

        // dd($request->all());
        $updateProduct = DB::table('products')
                        ->updateOrInsert(
                            ['id' => $id],
                            [
                                'product_name'=>$request->input('product_name'),
                                'image'=>$image_name,
                                'description'=>$request->input('description'),
                                'price'=>$request->input('price'),
                                'promotion_price'=>$request->input('promotion_price'),
                                'id_categorie'=>$request->input('id_categorie'),
                                'id_brand'=>$request->input('id_brand'),
                                'status' => $isStatus,
                                'updated_at' => date('Y/m/d H:i:s', time()),

                            ]
                        );
        
        
        return redirect()->route('product.list')
                         ->with('success', 'Cập nhật sản phẩm "'.$editProduct->product_name.'" thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $destroyProduct = DB::table('products')->where('id', $id)->first();
        // kiểm tra file image có tồn tại trong đĩa không và xóa
        $old_path = 'public/product_images/'.$destroyProduct->image;
        if (Storage::exists($old_path)) {
            Storage::delete($old_path);
        }

        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('product.list')
                         ->with('success', 'Xóa sản phẩm "'.$destroyProduct->product_name .'" thành công');
    }

    /**
     * search a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        if ($request->ajax()) {
            
            $output = '';
            
            $products = DB::table('products')
                            ->where('product_name', 'LIKE', '%' . $request->search . '%')
                            // ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                            
                            ->get();
            

            if ($products) {
                foreach ($products as $key => $product) {
                    
                    $output .= "<tr>
                                    <td>". ($key + 1)."</td>
                                    <td>". $product->product_name ."</td>
                                    <td class='td-img'><img src='/storage/product_images/". $product->image."'><img></td>
                                    <td>". number_format($product->price) ." VNĐ</td>
                                    <td>". number_format($product->promotion_price) ." VNĐ</td>
                                    <td>
                                        <span class='".($product->status === 1 ? 'status__active' : 'status__no-active')."'>".($product->status === 1 ? 'Đang kích hoạt' : 'Đang ẩn') ."</span>
                                    </td>
                                    <td>" . $product->created_at . "</td>
                                    <td class='table-action'>
                                        <a  href='/admin/product/edit/". $product->id."' 
                                            class=' btn-info' 
                                        >Edit</a>
                                        <a  href='/admin/product/destroy/". $product->id."' 
                                            class=' btn-danger' 
                                            onclick='return checkDelete()'
                                        >Delete</a>
                                    </td>
                                </tr>";
                }
            }
            
            return Response($output);
        }
    }
}
