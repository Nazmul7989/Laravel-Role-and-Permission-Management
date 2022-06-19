<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('pages.role.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('pages.role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'             => "required",
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

                $role = new Role();
                $role->name = $request->name;
                $role->save();

                $permissions = $request->permissions;

                if (!empty($permissions)) {
                    $role->syncPermissions($permissions);
                }


                DB::commit();

                $notification = array(
                    'message'    => 'Role and Permission Created Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('role.index')->with($notification);

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
}
