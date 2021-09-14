///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Users JavaScripts goes here       //
///////////////////////////////////////
(function(library) {
    "use strict";
    library(window.jQuery, window, document);

}(function($, window, document) {
    "use strict";
    var _args = window.xwb_var;
    var table_users;
    var bootbox = window.bootbox;
    var xwb = window.xwb;
    

    /**
     * Jquery functions goes here
     * 
     */
    $(function() {
        /**
         * Add user
         * 
         * @return mixed
         */
        $.fn.addUser = function(){
            this.bind( "click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                bootbox.dialog({
                    title: xwb.lang('btn_add_user'),
                    message: '<div class="row">'+
                        '<div class="col-md-12 col-sm-12 col-xs-12">'+
                        '<form class="form-horizontal" name="form_user" id="form_user">'+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="user_type">'+xwb.lang('lbl_user_type')+'</label>'+
                                '<div class="col-md-6">'+
                                    _args.usertype_option +
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="branch">'+xwb.lang('dt_heading_branch')+'</label>'+
                                '<div class="col-md-6">'+
                                    _args.branch_option +
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="department">'+xwb.lang('dt_heading_department')+'</label>'+
                                '<div class="col-md-6">'+
                                    _args.dept_option +
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="department_head">'+xwb.lang('lbl_department_head')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<div class="checkbox">'+
                                        '<label>'+
                                          '<input name="department_head" id="department_head" type="checkbox" value="1"> '+xwb.lang('dept_head_check')+
                                        '</label>'+
                                    '</div>'+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="first_name">'+xwb.lang('dt_fname')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="first_name" name="first_name" type="text" placeholder="'+xwb.lang('dt_fname')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="last_name">'+xwb.lang('dt_lname')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="last_name" name="last_name" type="text" placeholder="'+xwb.lang('dt_lname')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="phone_number">'+xwb.lang('lbl_phone')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="phone_number" name="phone_number" type="text" placeholder="'+xwb.lang('lbl_phone')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group"> ' +
                                '<label class="col-md-4 control-label" for="email">'+xwb.lang('dt_email')+'</label> ' +
                                '<div class="col-md-6"> ' +
                                    '<input id="email" name="email" type="text" placeholder="'+xwb.lang('dt_email')+'" class="form-control input-md"> ' +
                                '</div> ' +
                            '</div> ' +
                            '<div class="form-group"> ' +
                                '<label class="col-md-4 control-label" for="password">'+xwb.lang('lbl_pass')+'</label> ' +
                                '<div class="col-md-6"> ' +
                                    '<input id="password" name="password" type="password" placeholder="'+xwb.lang('lbl_pass')+'" class="form-control input-md"> ' +
                                '</div> ' +
                            '</div>' +
                            '<div class="form-group"> ' +
                                '<label class="col-md-4 control-label" for="cpassword">'+xwb.lang('lbl_confirm_pass')+'</label> ' +
                                '<div class="col-md-6"> ' +
                                    '<input id="cpassword" name="cpassword" type="password" placeholder="'+xwb.lang('lbl_confirm_pass')+'" class="form-control input-md"> ' +
                                '</div> ' +
                            '</div>' +
                        '</form> </div>  </div>',
                    buttons: {
                        success: {
                            label: xwb.lang('btn_save'),
                            className: "btn-success",
                            callback: function () {
                                var frm_data  = $("#form_user").serializeArray();

                                $.ajax({
                                    url: _args.varAddUser,
                                    type: "post",
                                    data: frm_data,
                                    success: function(data){
                                        data = $.parseJSON(data);
                                        if(data.status == true){
                                            xwb.Noty(data.message, 'success'); 
                                            table_users.ajax.reload();
                                            bootbox.hideAll();
                                        }else{
                                            xwb.Noty(data.message, 'error'); 
                                            return false;
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        console.log(XMLHttpRequest);
                                        console.log(textStatus);
                                        console.log(errorThrown);
                                    }
                                });
                                return false;
                            }
                        },
                        cancel: {
                            label: xwb.lang('btn_close'),
                            className: "btn-warning",
                            callback: function () {

                            }
                        }
                    }
                }); 
            });
        };


        /**
        * Edit user
        *
        * @return mixed
        */
        $.fn.editUser = function(){
            $( document ).delegate( '.xwb-edit-user', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var user_id = $(this).data('id');

                $.ajax({
                    url: _args.varEditUser,
                    type: "post",
                    data: {
                        u_id: user_id
                    },
                    success: function(data){
                        var edit_data = $.parseJSON(data);
                        var head_checked;
                        if(edit_data.head == 1)
                            head_checked = "checked";
                        else
                            head_checked = "";
                        
                        
                        bootbox.dialog({
                            title: xwb.lang('modal_edit_user'),
                            message: '<div class="row">  ' +
                                '<div class="col-md-12 col-sm-12 col-xs-12"> ' +
                                '<form class="form-horizontal" name="form_edit_user" id="form_edit_user"> ' +
                                    '<input type="hidden" id="id" name="id" />'+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="group">'+xwb.lang('lbl_user_type')+'</label>'+
                                        '<div class="col-md-6">'+
                                            _args.usertype_option +
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="branch">'+xwb.lang('dt_heading_branch')+'</label>'+
                                        '<div class="col-md-6">'+
                                            _args.branch_option +
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="department">'+xwb.lang('dt_heading_department')+'</label>'+
                                        '<div class="col-md-6">'+
                                            _args.dept_option +
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="department_head">'+xwb.lang('lbl_department_head')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<div class="checkbox">'+
                                                '<label>'+
                                                  '<input name="department_head" '+head_checked+' id="department_head" type="checkbox" value="1"> '+xwb.lang('dept_head_check')+
                                                '</label>'+
                                            '</div>'+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group"> ' +
                                        '<label class="col-md-4 control-label" for="first_name">'+xwb.lang('lbl_fname')+'</label> ' +
                                        '<div class="col-md-6"> ' +
                                            '<input id="first_name" name="first_name" type="text" placeholder="'+xwb.lang('lbl_fname')+'" class="form-control input-md"> ' +
                                        '</div> ' +
                                    '</div> ' +
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="last_name">'+xwb.lang('lbl_lname')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="last_name" name="last_name" type="text" placeholder="'+xwb.lang('lbl_lname')+'" class="form-control input-md"> ' +
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="email">'+xwb.lang('dt_email')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="email" name="email" type="text" placeholder="'+xwb.lang('dt_email')+'" class="form-control input-md" /> ' +
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="phone_number">'+xwb.lang('lbl_phone')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="phone_number" name="phone_number" type="text" placeholder="'+xwb.lang('lbl_phone')+'" class="form-control input-md"> ' +
                                        '</div> '+
                                    '</div> '+
                                '</form> </div>  </div>',
                            buttons: {
                                success: {
                                    label: xwb.lang('btn_update'),
                                    className: "btn-success",
                                    callback: function () {
                                        var frm_data  = $("#form_edit_user").serializeArray();

                                        $.ajax({
                                            url: _args.varUpdateUser,
                                            type: "post",
                                            data: frm_data,
                                            success: function(data){
                                                data = $.parseJSON(data);
                                                if(data.status == true){
                                                    xwb.Noty(data.message,'success');
                                                    table_users.ajax.reload();
                                                    bootbox.hideAll();
                                                }else{
                                                    xwb.Noty(data.message,'error');
                                                }
                                            },
                                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                console.log(XMLHttpRequest);
                                                console.log(textStatus);
                                                console.log(errorThrown);
                                            }
                                        });
                                        return false;
                                    }
                                },
                                cancel: {
                                    label: xwb.lang('btn_close'),
                                    className: "btn-warning",
                                    callback: function () {

                                    }
                                }
                            }
                        });

                        $("#form_edit_user").populate(edit_data);   

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            });
        };

        /**
         * Delete user
         * 
         * @return mixed
         */
        $.fn.deleteUser = function(){
            $( document ).delegate( '.xwb-delete-user', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var user_id = $(this).data('id');
                bootbox.confirm(xwb.lang('msg_deleted_record'), function(result){ 
                    if(result){
                        $.ajax({
                            url: _args.varDeleteUser,
                            type: "post",
                            data: {
                                user_id:user_id
                            },
                            success: function(data){
                                data = $.parseJSON(data);
                                if(data.status == true){
                                    xwb.Noty(data.message,'success');
                                    table_users.ajax.reload();
                                    bootbox.hideAll();
                                }else{
                                    xwb.Noty(data.message,'error');
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                    }
                });
            });
        };



        /**
         * Activate user
         * 
         * @return mixed
         */
        $.fn.activate = function(){
            $( document ).delegate( '.xwb-activate-user', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var user_id = $(this).data('id');
                var active = $(this).data('active');
                var activateURL;
                if(active==0)
                    activateURL = _args.varActivateUser;
                else
                    activateURL = _args.varDeactivateUser;

                $.ajax({
                    url: activateURL,
                    type: "post",
                    data: {
                        user_id:user_id
                    },
                    success: function(data){
                        data = $.parseJSON(data);
                        if(data.status === true){
                            xwb.Noty(data.message,'success');
                            table_users.ajax.reload();
                            bootbox.hideAll();
                        }else{
                            xwb.Noty(data.message,'error');
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            });
        };


        /**
         * Change user password
         * 
         * @return mixed
         */
        $.fn.changePass = function(){
            $( document ).delegate( '.xwb-change-pass', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var user_id = $(this).data('id');
                bootbox.dialog({
                    title: xwb.lang('modal_change_password'),
                    message: '<div class="row">  ' +
                        '<div class="col-md-12 col-sm-12 col-xs-12"> ' +
                        '<form class="form-horizontal" name="form_change_pass" id="form_change_pass"> ' +
                            '<input type="hidden" id="id" name="id" value="'+user_id+'" />'+
                            '<div class="form-group"> ' +
                                '<label class="col-md-4 control-label" for="first_name">'+xwb.lang('lbl_new_pass')+'</label> ' +
                                '<div class="col-md-6"> ' +
                                    '<input id="new_password" name="new_password" type="password" placeholder="'+xwb.lang('lbl_new_pass')+'" class="form-control input-md"> ' +
                                '</div> ' +
                            '</div> ' +
                            '<div class="form-group"> ' +
                                '<label class="col-md-4 control-label" for="first_name">'+xwb.lang('lbl_confirm_pass')+'</label> ' +
                                '<div class="col-md-6"> ' +
                                    '<input id="confirm_password" name="confirm_password" type="password" placeholder="'+xwb.lang('lbl_confirm_pass')+'" class="form-control input-md"> ' +
                                '</div> ' +
                            '</div> ' +
                        '</form> </div>  </div>',
                    buttons: {
                        success: {
                            label: xwb.lang('btn_update'),
                            className: "btn-success",
                            callback: function () {
                                var frm_data  = $("#form_change_pass").serializeArray();

                                $.ajax({
                                    url: _args.varChangePass,
                                    type: "post",
                                    data: frm_data,
                                    success: function(data){
                                        data = $.parseJSON(data);
                                        if(data.status == true){
                                            xwb.Noty(data.message,'success');
                                            table_users.ajax.reload();
                                            bootbox.hideAll();
                                        }else{
                                            xwb.Noty(data.message,'error');
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        console.log(XMLHttpRequest);
                                        console.log(textStatus);
                                        console.log(errorThrown);
                                    }
                                });
                                return false;
                            }
                        },
                        cancel: {
                            label: xwb.lang('btn_close'),
                            className: "btn-warning",
                            callback: function () {

                            }
                        }
                    }
                });
            });
        };



        /**
        *generate users datatable
        *
        */
        table_users = $('.table_users').DataTable({
            "ajax": {
                "url": _args.varGetUsers,
                "data": function ( d ) {
                    //d.extra_search = $('#extra').val();
                }
              },
              "order": [[ 0, "desc" ]]
        });



        ////////////////////////////////////
        // jQuery function call goes here //
        ////////////////////////////////////
       $('.xwb-add-user').addUser();
       $('.xwb-edit-user').editUser();
       $('.xwb-activate-user').activate();
       $('.xwb-change-pass').changePass();
       $('.xwb-delete-user').deleteUser();
       

        $(document).ajaxStart(function() {
            $("div.loader").show();
        }).ajaxStop(function() {
            $("div.loader").hide();
        });

    });
    
}));