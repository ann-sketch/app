///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Users Group JavaScripts goes here //
///////////////////////////////////////

(function(library) {
    "use strict";
    library(window.jQuery, window, document);

}(function($, window, document) {
    "use strict";
    var _args = window.xwb_var;
    var bootbox = window.bootbox;
    var xwb = window.xwb;
    var table_usergroup;
    

    /**
     * Jquery functions goes here
     * 
     */
    $(function() {


        /**
        * Edit User Group
        *
        * @return void
        */
        $.fn.editUGroup = function(group_id){
            $( document ).delegate( '.xwb-edit-group', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var group_id = $(this).data('group');

                $.ajax({
                    url: _args.varEditUGroup,
                    type: "post",
                    data: {
                        'group_id': group_id
                    },
                    success: function(data){
                        var edit_data = $.parseJSON(data);
                        bootbox.dialog({
                            title: xwb.lang('modal_edit_ugroup'),
                            message: '<div class="row">  ' +
                                '<div class="col-md-12 col-sm-12 col-xs-12"> ' +
                                '<form class="form-horizontal" name="form_edit_ugroup" id="form_edit_ugroup"> ' +
                                    '<input type="hidden" id="id" name="id" />'+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="description">'+xwb.lang('lbl_description')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="description" name="description" type="text" placeholder="'+xwb.lang('lbl_description')+'" class="form-control input-md"> '+
                                        '</div> '+
                                    '</div> '+
                                '</form> </div>  </div>',
                            buttons: {
                                success: {
                                    label: xwb.lang('btn_update'),
                                    className: "btn-success",
                                    callback: function () {
                                        var frm_data  = $("#form_edit_ugroup").serializeArray();

                                        $.ajax({
                                            url: _args.varUpdateUGroup,
                                            type: "post",
                                            data: frm_data,
                                            success: function(data){
                                                data = $.parseJSON(data);
                                                if(data.status == true){
                                                    xwb.Noty(data.message,'success');
                                                    table_usergroup.ajax.reload();
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
                        $("#form_edit_ugroup").populate(edit_data);   
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
         * Add User Group
         * 
         * @return mixed
         */
        $.fn.addGroup = function(){
            this.bind( "click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                bootbox.dialog({
                    title: xwb.lang('modal_add_ugroup'),
                    message: '<div class="row">'+
                        '<div class="col-md-12 col-sm-12 col-xs-12">'+
                        '<form class="form-horizontal" name="form_add_group" id="form_add_group">'+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="name">'+xwb.lang('lbl_name')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="name" name="name" type="text" placeholder="'+xwb.lang('lbl_name')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="description">'+xwb.lang('lbl_description')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="description" name="description" type="text" placeholder="'+xwb.lang('lbl_description')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                        '</form> </div>  </div>',
                    buttons: {
                        success: {
                            label: xwb.lang('btn_save'),
                            className: "btn-success",
                            callback: function () {
                                var frm_data  = $("#form_add_group").serializeArray();

                                $.ajax({
                                    url: _args.varAddUGroup,
                                    type: "post",
                                    data: frm_data,
                                    success: function(data){
                                        data = $.parseJSON(data);
                                        if(data.status == true){
                                            xwb.Noty(data.message,'success');
                                            table_usergroup.ajax.reload();
                                            bootbox.hideAll();
                                        }else{
                                            xwb.Noty(data.message,'success');
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
         * Delete user group
         * 
         * @return void
         */
        $.fn.deleteUGroup = function(group_id){
            $( document ).delegate( '.xwb-del-group', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var group_id = $(this).data('group');
                bootbox.confirm(xwb.lang('msg_deleted_record'), function(result){ 
                    if(result){
                        $.ajax({
                            url: _args.varDeleteUGroup,
                            type: "post",
                            data: {
                                'group_id':group_id
                            },
                            success: function(data){
                                data = $.parseJSON(data);
                                if(data.status == true){
                                    xwb.Noty(data.message,'success');
                                    table_usergroup.ajax.reload();
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
        *generate user group datatable
        *
        *
        */
        table_usergroup = $('.table_usergroup').DataTable({
            "ajax": {
                "url": _args.varGetUGroup,
                "data": function ( d ) {
                }
              },
              "order": [[ 0, "desc" ]]
        });

        $('.xwb-edit-group').editUGroup();
    });
    
}));