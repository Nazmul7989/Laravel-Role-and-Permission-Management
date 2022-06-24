@extends('layouts.master')

@section('content')

    <div class="main-content-inner">
        <div class="row">

            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="header-title float-left">Edit User</h4>
                            <a href="{{ route('users.index') }}" class="btn btn-success btn-sm float-right">User List</a>
                        </div>
                        <hr>
                        <form action="{{ route('users.update',$user->id) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Enter User Name">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('name'))?($errors->first('name')):''}}</div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" placeholder="example@gmail.com">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('email'))?($errors->first('email')):''}}</div>
                            </div>

                            <div class="form-group">
                                <label for="roles">Assign Role</label>
                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('roles'))?($errors->first('roles')):''}}</div>
                            </div>


                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- basic form end -->

        </div>
    </div>




@endsection

