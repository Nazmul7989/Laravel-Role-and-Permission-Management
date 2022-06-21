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

                            <div class="form-group">
                                <label for="name">Permissions</label>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkAll" value="1">
                                    <label class="form-check-label" for="checkAll">All</label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                            </div>
                                        </div>

                                        <div class="col-9 role-{{ $i }}-management-checkbox">
                                            @php
                                                $permissions = \App\Models\User::getPermissionsByGroupName($group->name);
                                                $j = 1;
                                            @endphp
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                    <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                                @php  $j++; @endphp
                                            @endforeach
                                            <br>
                                        </div>

                                    </div>
                                    <hr>
                                    @php  $i++; @endphp
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

@push('script')

    <script>

        $('#checkAll').click(function (){

            if ($(this).is(':checked')){
                $('input[type=checkbox]').prop('checked',true);
            }else {
                $('input[type=checkbox]').prop('checked',false);
            }
        })

        function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                classCheckBox.prop('checked', true);
            }else{
                classCheckBox.prop('checked', false);
            }
            implementAllChecked();
        }
            function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
                const classCheckbox = $('.'+groupClassName+ ' input');
                const groupIDCheckBox = $("#"+groupID);
                // if there is any occurance where something is not selected then make selected = false
                if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                    groupIDCheckBox.prop('checked', true);
                }else{
                    groupIDCheckBox.prop('checked', false);
                }
                implementAllChecked();
            }
            function implementAllChecked() {
                const countPermissions = {{ $all_permissions != null ? count($all_permissions) : 0 }};
                const countPermissionGroups = {{ $permission_groups != null ? count($permission_groups) : 0 }};

                if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                    $("#checkPermissionAll").prop('checked', true);
                }else{
                    $("#checkPermissionAll").prop('checked', false);
                }
            }



    </script>

@endpush
