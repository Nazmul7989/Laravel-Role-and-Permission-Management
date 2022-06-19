@extends('layouts.master')

@section('content')

    <div class="main-content-inner">
        <div class="row">

            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="header-title float-left">Create Roles</h4>
                            <a href="{{ route('role.index') }}" class="btn btn-success btn-sm float-right">Back to Role</a>
                        </div>
                        <hr>
                        <form action="{{ route('role.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role Name">
                            </div>

                            <div class="form-check">
                                @foreach($permissions as $permission)
                                <input type="checkbox" class="form-check-input" name="permissions[]" id="permission{{$permission->name}}" value="{{ $permission->id }}">
                                <label class="form-check-label" for="permission{{$permission->id}}">{{ $permission->name }}</label>
                                <br>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- basic form end -->

        </div>
    </div>


@endsection
