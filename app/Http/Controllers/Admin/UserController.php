<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\user\StoreUserRequest;
use App\Http\Requests\admin\user\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $users = DB::table('users')
                        ->select('*')
                        ->simplePaginate(5);
        
        return view('admin.user.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $image_name = '';
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/user_images');
            $image_name = $request->file('image')->hashName();
        }
        
        $brand = DB::table('users')->insertGetId([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password' => Hash::make($request->input('password')),
            'image'=>$image_name,
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'role' => $request->input('role'),
            'created_at' => date('Y/m/d H:i:s', time()),
        ]);

        return redirect()->route('user.list')
                         ->with('success','Thêm mới tài khoản "'.$request->input('email').'" thành công');
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
        $editUser = DB::table('users')->where('id', $id)->first();
        return view('admin.user.edit', ['editUser' => $editUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //
        $editUser = DB::table('users')->where('id', $id)->first();

        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/user_images');
            $image_name = $request->file('image')->hashName();

            // kiểm tra file image cũ có tồn tại và xóa
            $old_path = 'public/user_images/'.$editUser->image;
            
            if (Storage::exists($old_path)) {
                
                Storage::delete($old_path);
            } 
        } else {
            $image_name = $editUser->image;
        }

        $updateBrand = DB::table('users')
                        ->updateOrInsert(
                            ['id' => $id],
                            [
                                'name'=>$request->input('name'),
                                'email'=>$request->input('email'),
                                'password' => Hash::make($request->input('password')),
                                'image'=>$image_name,
                                'phone' => $request->input('phone'),
                                'address' => $request->input('address'),
                                'role' => $request->input('role'),
                                'updated_at' => date('Y/m/d H:i:s', time()),

                            ]
                        );
        
        
        return redirect()->route('user.list')
                         ->with('success', 'Cập nhật tài khoản "'.$editUser->email.'" thành công');
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
        $destroyUser = DB::table('users')->where('id', $id)->first(); 
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('user.list')
                         ->with('success', 'Xóa tài khoản "'.$destroyUser->email .'" thành công');
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
            $role = '';
            $image = '';
            $users = DB::table('users')
                            ->where('email', 'LIKE', '%' . $request->search . '%')
                            // ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                            ->get();
            

            if ($users) {
                foreach ($users as $key => $user) {
                    if($user->role === 1) {
                        $role = 'Admin';
                    } else {
                        $role = 'Khách hàng';
                    }
                    if($user->image) {
                        $image = "<td class='td-img'><img src='/storage/user_images/". $user->image."'><img></td>";
                    } else {
                        $image = '<td></td>';
                    }

                    $output .= "<tr>
                                    <td>". ($key + 1)."</td>
                                    <td>". $user->name ."</td>
                                    <td>". $user->email ." </td>
                                    ".$image."
                                    <td>(+84)". $user->phone ." </td>
                                    <td>" . $user->address . "</td>
                                    <td>" . $role . "</td>
                                    <td class='table-action'>
                                        <a  href='/admin/user/edit/". $user->id."' 
                                            class=' btn-info' 
                                        >Edit</a>
                                        <a  href='/admin/user/destroy/". $user->id."' 
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
