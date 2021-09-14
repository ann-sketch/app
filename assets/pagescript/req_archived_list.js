///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Archive items goes here           //
///////////////////////////////////////

var xwb = (function(library) {
    "use strict";
    var func = function (){};
    var $ = window.jQuery;
    var xwb = window.xwb;
    var _args = window.xwb_var;
    var bootbox = window.bootbox;
    var table_attachment;
    var table_req_items;
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
                                                '<th>'+xwb.lang('dt_items')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_category')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_item_description')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_supplier')+'</th>'+
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
                        label: "Close",
                        className: "btn-warning",
                        callback: function () {

                        }
                    }
                }

            });

            table_req_items = $('.table_req_items').DataTable({
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
                        label: xwb.lang('btn_close'),
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
                table_attachment = $('.table_attachment').DataTable({
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
        * Move request to archive
        *
        * @param int request_id
        *
        * @return void
        */
        unarchive: function (request_id){
            bootbox.confirm(xwb.lang('msg_restore_archive'), function(result){ 
                if(result){
                    $.ajax({
                        url: _args.varUnArchiveRequest,
                        type: "post",
                        data: {
                            request_id:request_id,
                        },
                        success: function(data){
                            data = $.parseJSON(data);
                            if(data.status == true){
                                xwb.Noty(data.message,'success');
                                xwb_var.table_archivereq_list.ajax.reload();
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
        }

    });

    var xwb_var = library(window.jQuery, window, document);
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
        _args.table_archivereq_list = $('.table_archivereq_list').DataTable({
            "processing": false, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [[ 0, "desc" ]], //Initial no order.
            "ajax": {
                "url": _args.varGetArchRequest,
                "data": function ( d ) {
                    //d.extra_search = $('#extra').val();
                }
              },
            "columnDefs": [
                { 
                    "targets": [ 7,9 ], 
                    "orderable": false, //set not orderable
                },
            ],
        });


    });
    return _args;
}));
