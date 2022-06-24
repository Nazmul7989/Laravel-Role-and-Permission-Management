@extends('layouts.master')

@section('content')

    <div class="main-content-inner">
        <div class="row">

            <!-- Primary table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="header-title float-left">User List</h4>
                            @if (auth()->user()->can('user_create'))
                                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right">Create User</a>
                            @endif
                        </div>
                        <hr>

                        <div class="data-tables datatable-primary">
                            <table id="dataTable">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Id</th>
                                    <th style="width: 150px;">Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->code }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if (auth()->user()->can('user_edit'))
                                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        @endif
                                        @if (auth()->user()->can('user_delete'))
                                           <a href="{{ route('users.delete',$user->id) }}" onclick="return confirm('Do you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                                        @endif
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
