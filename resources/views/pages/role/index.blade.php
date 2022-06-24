@extends('layouts.master')

@section('content')

    <div class="main-content-inner">
        <div class="row">

            <!-- Primary table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="header-title float-left">All Roles</h4>
                            <a href="{{ route('role.create') }}" class="btn btn-success btn-sm float-right">Create Role</a>
                        </div>
                        <hr>

                        <div class="data-tables datatable-primary">
                            <table id="dataTable">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Id</th>
                                    <th style="width: 150px;">Name</th>
                                    <th>Permissions</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-primary">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('role.edit',$role->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('role.delete',$role->id) }}" onclick="return confirm('Do you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                               @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Primary table end -->

        </div>
    </div>


@endsection
