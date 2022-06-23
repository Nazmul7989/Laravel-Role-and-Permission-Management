<script>

    $('#checkPermissionAll').click(function (){

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
