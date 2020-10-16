<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\admin\brand\StoreBrandRequest;
use App\Http\Requests\admin\brand\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = DB::table('brands')
                        ->select('*')
                        ->simplePaginate(5);
        return view('admin.brand.list', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        //
        // kiểm tra status
        $isStatus = $request->input('status');
        // dd($isStatus);
        if ($isStatus === null) {
            $isStatus = 0;
        } else {
            $isStatus = 1;
        }
        
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/brand_images');
            $image_name = $request->file('image')->hashName();
        }
        
        $brand = DB::table('brands')->insertGetId([
            'brand_name'=>$request->input('brand_name'),
            'image'=>$image_name,
            'status' => $isStatus,
            'created_at' => date('Y/m/d H:i:s', time()),
        ]);

        return redirect()->route('brand.list')
                         ->with('success','Thêm mới nhãn hiệu "'.$request->input('brand_name').'" thành công');
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
        $editBrand = DB::table('brands')->where('id', $id)->first();
        return view('admin.brand.edit', ['editBrand' => $editBrand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        //
        $editBrand = DB::table('brands')->where('id', $id)->first();
        
        $isStatus = $request->input('status');
        if ($isStatus === null) {
            $isStatus = 0;
        } else {
            $isStatus = 1;
        }

        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/brand_images');
            $image_name = $request->file('image')->hashName();

            // kiểm tra file image cũ có tồn tại và xóa
            $old_path = 'public/brand_images/'.$editBrand->image;
            
            if (Storage::exists($old_path)) {
                
                Storage::delete($old_path);
            } 
        } else {
            $image_name = $editBrand->image;
        }

        $updateBrand = DB::table('brands')
                        ->updateOrInsert(
                            ['id' => $id],
                            [
                                'brand_name' => $request->input('brand_name'),
                                'image'=>$image_name,
                                'status' => $isStatus,
                                'updated_at' => date('Y/m/d H:i:s', time()),

                            ]
                        );
        
        
        return redirect()->route('brand.list')
                         ->with('success', 'Cập nhật nhãn hiệu "'.$editBrand->brand_name.'" thành công');
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
        $destroyBrand = DB::table('brands')->where('id', $id)->first();
        // kiểm tra file image có tồn tại trong đĩa không và xóa
        $old_path = 'public/brand_images/'.$destroyBrand->image;
        if (Storage::exists($old_path)) {
            Storage::delete($old_path);
        }

        DB::table('brands')->where('id', $id)->delete();
        return redirect()->route('brand.list')
                         ->with('success', 'Xóa nhãn hiệu "'.$destroyBrand->brand_name .'" thành công');
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
            $brands = DB::table('brands')
                            ->where('brand_name', 'LIKE', '%' . $request->search . '%')
                            // ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                            ->get();

            if ($brands) {
                foreach ($brands as $key => $brand) {
                    $output .= "<tr>
                                    <td>". ($key + 1)."</td>
                                    <td>". $brand->brand_name ."</td>
                                    <td><img width='30%' src='/storage/brand_images/". $brand->image."'><img></td>
                                    <td>
                                        <span class='".($brand->status === 1 ? 'status__active' : 'status__no-active')."'>".($brand->status === 1 ? 'Đang kích hoạt' : 'Đang ẩn') ."</span>
                                    </td>
                                    <td>" . $brand->created_at . "</td>
                                    <td class='table-action'>
                                        <a  href='/admin/brand/edit/". $brand->id."' 
                                            class=' btn-info' 
                                        >Edit</a>
                                        <a  href='/admin/brand/destroy/". $brand->id."' 
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
