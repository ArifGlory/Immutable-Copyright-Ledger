<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use App\DataTables\UsersDataTable;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function data(Request $request){
        $user = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'superadmin');
            })
            ->get();

        if (!$user){
            return [
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
        }else{
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('status',function ($item){
                    if($item->email_verified_at == null){
                        $status = '<span class="badge bg-gradient-warning"> Belum Aktif <i class="fas fa-exclamation-triangle text-xs ms-1" aria-hidden="true"></i> &nbsp; </span>';
                    }else{
                        $status = '<span class="badge bg-success text-black-50"> Aktif <i class="fas fa-check text-xs ms-1" aria-hidden="true"></i> &nbsp; </span>';
                    }

                    return $status;
                })
                ->editColumn('action', function ($item) {

                    $buttons =
                        // Tombol Lihat Detail
                        /*'<a class="btn btn-info my-auto view-btn p-2 rounded-1" ' .
                        'href="' . route('user.show', encodeId($item['id'])) . '" ' .
                        'data-toggle="tooltip" ' .
                        'title="Lihat Detail User"> ' .
                        '<i class="fas fa-eye text-white m-0"></i> ' .
                        '</a> ' .*/

                        // Tombol Edit
                        '<a class="btn btn-warning my-auto edit-btn p-2 rounded-1" ' .
                        'href="' . route('user.edit', encodeId($item['id'])) . '" ' .
                        'data-toggle="tooltip" ' .
                        'title="Edit User"> ' .
                        '<i class="fas fa-edit text-white m-0"></i> ' .
                        '</a> ';

                    // Tambahkan tombol hapus hanya jika user login adalah superadmin
                    if (Auth::user()->hasRole('superadmin')) {
                        /*$buttons .=
                            '<button class="btn btn-danger my-auto delete-btn p-2 rounded-1" ' .
                            'data-id="' . encodeId($item['id']) . '" ' .
                            'data-toggle="tooltip" title="Hapus User"> ' .
                            '<i class="fas fa-trash text-white m-0"></i> ' .
                            '</button>';*/
                    }

                    return $buttons;

                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function editPassword($id){
        $user = User::findOrFail(decodeId($id));

        return view('users.edit_password',compact('user'));
    }

    public function updatePassword(Request $request,$id){
        $validatedData = $request->validate([
            'password_old' => 'required',
            'password_new' => 'required',
        ]);

        $user = User::findOrFail(decodeId($id));

        // Verifikasi password lama
        if (!Hash::check($request->password_old, $user->password)) {
            return ResponseJson(null, false, "Password lama tidak valid ", 202);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password_new),
        ]);

        return ResponseJson(null, true, "Password berhasil diubah ", 200);
    }

}
