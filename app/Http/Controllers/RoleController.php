<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //Role View
    public function index()
    {
        $roles = Role::all();
        return view('pages.role.index',compact('roles'));
    }

    //Role Create
    public function create()
    {
        $all_permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('pages.role.create',compact('all_permissions','permission_groups'));
    }

    //Role Store
    public function store(Request $request)
    {
        $rules = [
            'name'             => "required:unique:role,name",
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

    //Role edit
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $all_permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('pages.role.edit',compact('role','all_permissions','permission_groups'));
    }

    //Update Role
    public function update(Request $request,$id)
    {
        $rules = [
            'name'             => "required:unique:role,name,".$id,
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

                $role =Role::findById($id);
                $role->name = $request->name;
                $role->save();

                $permissions = $request->permissions;

                if (!empty($permissions)) {
                    $role->syncPermissions($permissions);
                }


                DB::commit();

                $notification = array(
                    'message'    => 'Role and Permission Updated Successfully.',
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


    //Role Delete
    public function destroy($id)
    {
        $role =Role::findOrFail($id);
        $role->delete();

        $notification = array(
            'message'    => 'Role and Permission Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }




}
