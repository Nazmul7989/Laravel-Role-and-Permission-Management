<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('pages.users.index',compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name'             => "required",
            'email'             => "required|unique:users,email",
            'password'             => "required|min:6|max:20",
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            $notification = array(
                'message'    => 'Opps! Please fill out the required field of the Form.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }else {

            try {
                DB::beginTransaction();

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->code = $request->password;
                $user->save();

                $roles = $request->roles;

                if (!empty($roles)) {
                    $user->assignRole($roles);
                }


                DB::commit();

                $notification = array(
                    'message'    => 'User Created Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('users.index')->with($notification);

            }catch (\Exception $exception){
                DB::rollBack();

                $notification = array(
                    'message'    => $exception->getMessage(),
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);

            }
        }


    }



    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('pages.users.edit',compact('user','roles'));
    }


    public function update(Request $request, $id)
    {

        $rules = [
            'name'             => "required",
            'email'             => "required|unique:users,email,".$id,
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            $notification = array(
                'message'    => 'Opps! Please fill out the required field of the Form.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);
        }else {

            try {
                DB::beginTransaction();

                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                $roles = $request->roles;

                if (!empty($roles)) {
                    $user->syncRoles($roles);
                }


                DB::commit();

                $notification = array(
                    'message'    => 'User Updated Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('users.index')->with($notification);

            }catch (\Exception $exception){
                DB::rollBack();

                $notification = array(
                    'message'    => $exception->getMessage(),
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);

            }
        }


    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $notification = array(
            'message'    => 'User Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
