<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\admin\categorie\StoreCategorieRequest;
use App\Http\Requests\admin\categorie\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = DB::table('categories')
                        ->select('*')
                        ->simplePaginate(5);
        return view('admin.categorie.list', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorieRequest $request)
    {
        //
        $isStatus = $request->input('status');
        if ($isStatus === null) {
            $isStatus = 0;
        } else {
            $isStatus = 1;
        }

        $reqCategorie = DB::table('categories')->insertGetId(
            [
                
                'categorie_name' => $request->input('categorie_name'),
                'status' => $isStatus,
                'created_at' => date('Y/m/d H:i:s', time()),

            ]

        );

        return redirect()->route('categorie.list')
                         ->with('success','Thêm mới danh mục "'.$request->input('categorie_name').'" thành công');
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
        $editCategorie = DB::table('categories')->where('id', $id)->first();
        return view('admin.categorie.edit', ['editCategorie' => $editCategorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieRequest $request, $id)
    {
        //
        $editCategorie = DB::table('categories')->where('id', $id)->first();
        // kiểm tra status
        $isStatus = $request->input('status');
        if ($isStatus === null) {
            $isStatus = 0;
        } else {
            $isStatus = 1;
        }

        $updateCate = DB::table('categories')
                        ->updateOrInsert(
                            ['id' => $id],
                            [
                                'categorie_name' => $request->input('categorie_name'),
                                'status' => $isStatus,
                                'updated_at' => date('Y/m/d H:i:s', time()),

                            ]
                        );
        
        
        return redirect()->route('categorie.list')
                         ->with('success', 'Cập nhật danh mục "'.$editCategorie->categorie_name.'" thành công');
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
        $destroyCategorie = DB::table('categories')->where('id', $id)->first(); 
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('categorie.list')
                         ->with('success', 'Xóa danh mục "'.$destroyCategorie->categorie_name .'" thành công');
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
            $categories = DB::table('categories')
                            ->where('categorie_name', 'LIKE', '%' . $request->search . '%')
                            // ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                            ->get();

            if ($categories) {
                foreach ($categories as $key => $categorie) {
                    $output .= "<tr>
                                    <td>". ($key + 1)."</td>
                                    <td>". $categorie->categorie_name ."</td>
                                    <td>
                                        <span class='".($categorie->status === 1 ? 'status__active' : 'status__no-active')."'>".($categorie->status === 1 ? 'Đang kích hoạt' : 'Đang ẩn') ."</span>
                                    </td>
                                    <td>" . $categorie->created_at . "</td>
                                    <td class='table-action'>
                                        <a  href='/admin/categorie/edit/". $categorie->id."' 
                                            class=' btn-info' 
                                        >Edit</a>
                                        <a  href='/admin/categorie/destroy/". $categorie->id."' 
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
