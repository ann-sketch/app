///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Staff Request Script goes here    //
///////////////////////////////////////
var xwb = (function(library) {
    "use strict";
    var func = function (){};
    var $ = window.jQuery;
    var xwb = window.xwb;
    var _args = window.xwb_var;
    var bootbox = window.bootbox;

    $.extend(func, {
        /**
        * View Items per request
        * @param int request_id
        *
        * @return mixed
        */

        viewItems: function (request_id){
            var expenditure = "";
            var qty_price = "";
            if(_args.group_name == 'budget')
                expenditure = '<th>'+xwb.lang('dt_heading_expenditure')+'</th>';
            
            if(_args.group_name == 'admin')
                qty_price = '<th>'+xwb.lang('dt_heading_price')+'</th><th>'+xwb.lang('dt_heading_totalprice')+'</th>';

            bootbox.dialog({
                title: xwb.lang('modal_req_items'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<div class="table-responsive">'+
                                    '<table class="table table_req_items">'+
                                        '<thead>'+
                                            '<tr>'+
                                                '<th>'+xwb.lang('dt_heading_item_name')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_category')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_item_description')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_quantity')+'</th>'+
                                                expenditure+
                                                qty_price+
                                                '<th>'+xwb.lang('dt_heading_attachment')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_eta')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_datedelivered')+'</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody>'+
                                    '<table>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
                className: 'width-90p',
                buttons:{
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    }
                }

            });

            _args.table_req_items = $('.table_req_items').DataTable({
                "ajax": {
                    "url": _args.varGetRequestItems,
                    "data": function ( d ) {
                        d.request_id = request_id;
                    }
                  },
                  "order": [[ 0, "desc" ]]
            });
        },

        /**
        * View Attachment
        * @param int po_id
        *
        * @return mixed
        */
        viewAttachmentPreview: function (po_id){

            bootbox.dialog({
                title: xwb.lang('modal_attachment'),
                message: '<div class="row">'+
                    '<div class="col-md-12 col-sm-12 col-xs-12">'+
                        '<div class="panel panel-success">'+
                            '<div class="panel-heading">'+
                              '<h3 class="panel-title">'+xwb.lang('modal_attachment')+'</h3>'+
                            '</div>'+
                            '<div class="panel-body">'+
                                '<form class="form-horizontal" name="form_add_attachment" id="form_add_attachment">'+
                                    '<input type="hidden" name="po_id" id="po_id" value="'+po_id+'">'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                            '<div class="input-group">'+
                                                '<input id="attachment" name="attachment" type="file">'+
                                            '</div>'+
                                        '</div> '+
                                        '<hr />'+
                                        '<span class="input-group-btn">'+
                                            '<button type="button" onClick="xwb.submitAttachment()" class="btn btn-primary">'+xwb.lang('btn_upload')+'</button>'+
                                        '</span>'+
                                    '</div> '+
                                '</form>'+
                                '<hr />'+
                                '<div class="table-responsive">'+
                                    '<table class="table table_attachment">'+
                                        '<thead>'+
                                            '<tr>'+
                                                '<th>#</th>'+
                                                '<th>'+xwb.lang('dt_heading_filename')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_action')+'</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody>'+
                                        '</tbody>'+
                                    '</table>'+
                            '</div>'+

                        '</div>'+
                    '</div></div>',
                buttons: {
                    close: {
                        label: "Close",
                        className: "btn-warning",
                        callback: function () {

                        }
                    }
                }
            }).init(function(){
                /**
                *generate attachment datatable
                *
                *
                */
                _args.table_attachment = $('.table_attachment').DataTable({
                    "ajax": {
                        "url": _args.varGetAttachment,
                        "data": function ( d ) {
                            d.po_id = po_id;
                        }
                      },
                      "order": [[ 0, "desc" ]]
                });
            }); 

        },


        /**
        * Upload attachment
        *
        *
        * @return void
        */
        submitAttachment: function (){

            $("#form_add_attachment").ajaxForm({
                url: _args.varAddAttachment,
                type: "post",
                beforeSubmit: function(arr, $form, options){
                    var csrf = xwb.getCSRF();
                    arr = $.merge(arr,csrf);
                },
                success: function(data){
                    data = $.parseJSON(data);
                    xwb.setCSRF(data.csrf_hash);
                    if(data.status == true){
                        xwb.Noty(data.message,'success');
                        _args.table_attachment.ajax.reload();
                        $("#attachment").val('');
                    }else{
                        xwb.Noty(data.message,'error');
                    }
                },
            }).submit();
        },
        /**
        * Remove temporary file attachment
        *
        * @param int attachment_id
        *
        * @return void
        */
        deleteReqAttachment: function (attachment_id){
            bootbox.confirm(xwb.lang('msg_delete_attachment'), function(result){ 
                if(result){
                    $.ajax({
                        url: _args.varRemoveAttachment,
                        type: "post",
                        data: {
                            attachment_id:attachment_id,
                        },
                        success: function(data){
                            data = $.parseJSON(data);
                            if(data.status == true){
                                xwb.Noty(data.message,'success'); 
                                _args.table_attachment.ajax.reload();
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
        },

    });

    window.func = func;
    library(window.jQuery, window, document);
    return func;

}(function($, window, document) {
    "use strict";

    var _args = window.xwb_var;

    $(function() {
        /**
        *generate request list datatable
        *
        *
        */
        _args.table_staff_request = $('.table_staff_request').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [[ 0, "desc" ]], //Initial no order.
            "ajax": {
                "url": _args.varGetStaffRequest,
                "data": function ( d ) {
                    //d.extra_search = $('#extra').val();
                }
            },
            "columnDefs": [
                { 
                    "targets": [ 7], 
                    "orderable": false, //set not orderable
                },
            ],
        });



        $(document).on('change',".expenditure",function(){
            var val = $(this).val();
            var item_id = $(this).data('itemid');
            $.ajax({
                url: _args.varSetExpenditureItem,
                type: "post",
                data: {
                    expenditure: val,
                    item_id: item_id
                },
                success: function(data){
                    data = $.parseJSON(data);
                    if(data.status == true){
                        xwb.Noty(data.message,'success');
                        _args.table_staff_request.ajax.reload();
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

        });


    });
    
}));