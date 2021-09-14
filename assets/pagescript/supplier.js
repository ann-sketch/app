///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Supplier JavaScripts goes here    //
///////////////////////////////////////

(function(library) {
    "use strict";
    library(window.jQuery, window, document);

}(function($, window, document) {
    "use strict";
    var _args = window.xwb_var;
    var bootbox = window.bootbox;
    var xwb = window.xwb;
    var table_supplier;
    

    /**
     * Jquery functions goes here
     * 
     */
    $(function() {

        /**
         * Add Supplier
         * 
         * @return mixed
         */
        $.fn.addSupplier = function(){
            this.bind( "click", function(e) {
                e.preventDefault();
                e.stopPropagation();

                bootbox.dialog({
                    title: xwb.lang('modal_add_supplier'),
                    message: '<div class="row">'+
                        '<div class="col-md-12 col-sm-12 col-xs-12">'+
                        '<form class="form-horizontal" name="form_add_supplier" id="form_add_supplier">'+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="supplier_name">'+xwb.lang('lbl_supplier_name')+': </label>'+
                                '<div class="col-md-6">'+
                                    '<input id="supplier_name" name="supplier_name" type="text" placeholder="'+xwb.lang('lbl_supplier_name')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="tel_number">'+xwb.lang('dt_tel_num')+': </label>'+
                                '<div class="col-md-6">'+
                                    '<input id="tel_number" name="tel_number" type="text" placeholder="'+xwb.lang('dt_tel_num')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="phone_number">'+xwb.lang('dt_mobile_num')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="phone_number" name="phone_number" type="text" placeholder="'+xwb.lang('dt_mobile_num')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="fax">'+xwb.lang('dt_fax')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="fax" name="fax" type="text" placeholder="'+xwb.lang('dt_fax')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="email">'+xwb.lang('lbl_email')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<input id="email" name="email" type="text" placeholder="'+xwb.lang('lbl_email')+'" class="form-control input-md"> '+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="email">'+xwb.lang('payment_terms_label')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<select name="payment_terms" id="payment_terms" class="form-control">'+
                                        '<option value="">'+xwb.lang('select_option')+'</option>'+
                                        '<option value="cash">'+xwb.lang('lbl_cash')+'</option>'+
                                        '<option value="open_account">'+xwb.lang('lbl_open_account')+'</option>'+
                                        '<option value="secured_account">'+xwb.lang('lbl_secured_account')+'</option>'+
                                    '</select>'+
                                '</div> '+
                            '</div> '+
                            '<div class="form-group">'+
                                '<label class="col-md-4 control-label" for="address">'+xwb.lang('dt_address')+'</label>'+
                                '<div class="col-md-6">'+
                                    '<textarea name="address" id="address" class="form-control"></textarea>'+
                                '</div> '+
                            '</div> '+
                        '</form> </div>  </div>',
                    buttons: {
                        success: {
                            label: "Save",
                            className: xwb.lang('btn_save'),
                            callback: function () {
                                var frm_data  = $("#form_add_supplier").serializeArray();

                                $.ajax({
                                    url: _args.varAddSupplier,
                                    type: "post",
                                    data: frm_data,
                                    success: function(data){
                                        data = $.parseJSON(data);
                                        if(data.status == true){
                                            xwb.Noty(data.message,'success');
                                            table_supplier.ajax.reload();
                                            bootbox.hideAll();
                                        }else{
                                            xwb.Noty(data.message,'error');
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
        * Edit Suplier
        *
        * @param int supplier_id
        * @return mixed
        */
        $.fn.editSupplier = function (){
            $( document ).delegate( '.xwb-edit-supplier', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var supplier_id = $(this).data('supplier');

                $.ajax({
                    url: _args.varEditSupplier,
                    type: "post",
                    data: {
                        supplier_id: supplier_id
                    },
                    success: function(data){
                        var edit_data = $.parseJSON(data);
                        bootbox.dialog({
                            title: xwb.lang('modal_edit_supplier'),
                            message: '<div class="row">  ' +
                                '<div class="col-md-12 col-sm-12 col-xs-12"> ' +
                                '<form class="form-horizontal" name="form_edit_supplier" id="form_edit_supplier"> ' +
                                    '<input type="hidden" id="id" name="id" />'+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="supplier_name">'+xwb.lang('lbl_supplier_name')+': </label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="supplier_name" name="supplier_name" type="text" placeholder="'+xwb.lang('lbl_supplier_name')+'" class="form-control input-md"> '+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="tel_number">'+xwb.lang('dt_tel_num')+': </label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="tel_number" name="tel_number" type="text" placeholder="'+xwb.lang('dt_tel_num')+'r" class="form-control input-md"> '+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="phone_number">'+xwb.lang('dt_mobile_num')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="phone_number" name="phone_number" type="text" placeholder="'+xwb.lang('dt_mobile_num')+'" class="form-control input-md"> '+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="fax">'+xwb.lang('dt_fax')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="fax" name="fax" type="text" placeholder="'+xwb.lang('dt_fax')+'" class="form-control input-md"> '+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="email">'+xwb.lang('lbl_email')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<input id="email" name="email" type="text" placeholder="'+xwb.lang('lbl_email')+'" class="form-control input-md"> '+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="email">'+xwb.lang('payment_terms_label')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<select name="payment_terms" id="payment_terms" class="form-control">'+
                                                '<option value="">'+xwb.lang('select_option')+'</option>'+
                                                '<option value="cash">'+xwb.lang('lbl_cash')+'</option>'+
                                                '<option value="open_account">'+xwb.lang('lbl_open_account')+'</option>'+
                                                '<option value="secured_account">'+xwb.lang('lbl_secured_account')+'</option>'+
                                            '</select>'+
                                        '</div> '+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="address">'+xwb.lang('dt_address')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<textarea name="address" id="address" class="form-control"></textarea>'+
                                        '</div> '+
                                    '</div> '+
                                '</form> </div>  </div>',
                            buttons: {
                                success: {
                                    label: xwb.lang('btn_update'),
                                    className: "btn-success",
                                    callback: function () {
                                        var frm_data  = $("#form_edit_supplier").serializeArray();

                                        $.ajax({
                                            url: _args.varUpdateSupplier,
                                            type: "post",
                                            data: frm_data,
                                            success: function(data){
                                                data = $.parseJSON(data);
                                                if(data.status == true){
                                                    xwb.Noty(data.message,'success');
                                                    table_supplier.ajax.reload();
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
                        $("#form_edit_supplier").populate(edit_data);   
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
        * Delete Supplier
        * @param int id
        *
        * @return mixed
        */
        $.fn.deleteSupplier = function (){
            $( document ).delegate( '.xwb-del-supplier', "click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var supplier_id = $(this).data('supplier');

                bootbox.confirm(xwb.lang('msg_deleted_record'), function(result){ 
                    if(result){
                        $.ajax({
                            url: _args.varDeleteSupplier,
                            type: "post",
                            data: {
                                'id':supplier_id
                            },
                            success: function(data){
                                data = $.parseJSON(data);
                                if(data.status == true){
                                    xwb.Noty(data.message,'success');
                                    table_supplier.ajax.reload();
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
        *generate supplier list datatable
        *
        *
        */
        table_supplier = $('.table_supplier').DataTable({
            "ajax": {
                "url": _args.varGetSupplier,
                "data": function ( d ) {
                    //d.branches = $('#branches').val();
                }
              },
              "order": [[ 0, "desc" ]]
        });


        
        $('.xwb-add-supplier').addSupplier();
        $('.xwb-edit-supplier').editSupplier();
        $('.xwb-del-supplier').deleteSupplier();
        
    });
    
}));