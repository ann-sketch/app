///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Assigned request Script goes here //
///////////////////////////////////////
var xwb = (function(library) {
    "use strict";
    var func = function (){};
    var $ = window.jQuery;
    var xwb = window.xwb;
    var _args = window.xwb_var;
    var bootbox = window.bootbox;

    var table_req_items;
    var total_per_supplier;

    $.extend(func, {
        /**
        * View Items per request
        * @param int request_id
        *
        * @return mixed
        */
        viewItems: function (request_id){
            bootbox.dialog({
                title: xwb.lang('modal_req_items'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<div class="table-responsive">'+
                                    '<table class="table table_req_items">'+
                                        '<thead>'+
                                            '<tr>'+
                                                '<th>'+xwb.lang('dt_items')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_attachment')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_item_description')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_supplier')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_quantity')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_price')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_totalprice')+'</th>'+
                                                '<th>'+xwb.lang('dt_action')+'</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody>'+
                                    '<table>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
                size: 'large',
                buttons:{
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    }
                }

            }).init(function(){
                table_req_items = $('.table_req_items').DataTable({
                    "ajax": {
                        "url": _args.varGetRequestItemsCanvasser,
                        "data": function ( d ) {
                            d.request_id = request_id;
                        }
                    },
                    "order": [[ 0, "desc" ]]
                });
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
                              '<h3 class="panel-title">'+xwb.lang('dt_heading_attachment')+'</h3>'+
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
                                                '<th>'+xwb.lang('dt_action')+'</th>'+
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
            }); 


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
                        xwb.Noty(data.message, 'success'); 
                        _args.table_attachment.ajax.reload();
                        $("#attachment").val('');
                    }else{
                        xwb.Noty(data.message, 'error'); 
                    }
                },
            }).submit();
        },


        

        /**
        * Forward to budget department
        *
        * @param int canvass_id
        *
        * @return mixed
        */
        assignToBudget: function (canvass_id){
            bootbox.dialog({
                title: xwb.lang('modal_forward_to_budget'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<div class="form-group">'+
                                    '<label class="col-md-4 control-label" for="bdusers">'+xwb.lang('budget_dept_label')+'</label>'+
                                    '<div class="col-md-6">'+
                                        '<select name="bdusers" id="bdusers" style="width:100%;">'+
                                        _args.BDUsersOptions+
                                        '</select>'+
                                    '</div> '+
                                '</div> '+
                            '</div>'+
                        '</div>',
                buttons:{
                    assign: {
                        label: xwb.lang('btn_assign'),
                        className: "btn-success",
                        callback: function () {
                            $.ajax({
                                url: _args.varAssignBudget,
                                type: "post",
                                data: {
                                    canvass_id:canvass_id,
                                    user_id:$("#bdusers").val()
                                },
                                success: function(data){
                                    data = $.parseJSON(data);
                                    if(data.status == true){
                                        xwb.Noty(data.message,'success');
                                        xwb_var.table_assigned_req.ajax.reload();
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
                    },
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    },
                }

            });

            $("#bdusers").select2({});
        },

        /**
        * Forward to purchasing department
        *
        * @param int canvass_id
        *
        * @return mixed
        */
        assignToAdmin: function (canvass_id){
            bootbox.dialog({
                title: xwb.lang('modal_forward_purchasing'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<p>'+xwb.lang('msg_assign_purchasing')+'</p>'+
                            '</div>'+
                        '</div>',
                buttons:{
                    assign: {
                        label: xwb.lang('btn_assign'),
                        className: "btn-success",
                        callback: function () {
                            $.ajax({
                                url: _args.varAssignPurchasing,
                                type: "post",
                                data: {
                                    canvass_id:canvass_id,
                                    //user_id:$("#pdusers").val()
                                },
                                success: function(data){
                                    data = $.parseJSON(data);
                                    if(data.status == true){
                                        xwb.Noty(data.message,'success');
                                        xwb_var.table_assigned_req.ajax.reload();
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
                    },
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    },
                }

            });

            $("#pdusers").select2({});
        },

        /**
        * View reason and response
        *
        * @param int canvass_id
        *
        * @return mixed
        */
        view_response: function (canvass_id){
            $.ajax({
                url: _args.varGetResponse,
                type: "post",
                data: {
                    canvass_id:canvass_id,
                },
                success: function(data){
                    data = $.parseJSON(data);
                    bootbox.dialog({
                        title: xwb.lang('modal_reason_response'),
                        message: '<div class="row">'+
                                    '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                        '<form class="form-horizontal">'+
                                        '<div class="form-group">'+
                                            '<label class="col-md-4 control-label" for="reason">'+xwb.lang('label_reason')+':</label>'+
                                            '<div class="col-md-6">'+
                                                '<textarea name="reason" readonly id="reason" class="form-control">'+data.reason+'</textarea>'+
                                            '</div> '+
                                        '</div> '+
                                        '<hr class="clearfix" />'+
                                        '<div class="form-group">'+
                                            '<label class="col-md-4 control-label" for="response">'+xwb.lang('your_response_label')+'</label>'+
                                            '<div class="col-md-6">'+
                                                '<textarea name="response" id="response" class="form-control"></textarea>'+
                                            '</div> '+
                                        '</div> '+
                                        '</form> '+
                                    '</div>'+
                                '</div>',
                        buttons:{
                            assign: {
                                label: xwb.lang('btn_respond'),
                                className: "btn-success",
                                callback: function () {
                                    $.ajax({
                                        url: _args.varRespond,
                                        type: "post",
                                        data: {
                                            canvass_id:canvass_id,
                                            response:$("#response").val()
                                        },
                                        success: function(data){
                                            data = $.parseJSON(data);
                                            if(data.status == true){
                                                xwb.Noty(data.message,'success'); 
                                                xwb_var.table_assigned_req.ajax.reload();
                                                
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
                                }
                            },
                            cancel: {
                                label: xwb.lang('btn_close'),
                                className: "btn-warning",
                                callback: function () {

                                }
                            },
                        }

                    });

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        },


        /**
        * Return to requisitioner
        *
        * @param int canvass_id
        *
        * @return mixed
        */
        toRequisitioner: function (canvass_id){
            bootbox.dialog({
                title: xwb.lang('hist_to_initiator'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<form class="form-horizontal">'+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="message">'+xwb.lang('message_label')+': </label>'+
                                        '<div class="col-md-6">'+
                                            '<textarea name="message" id="message" class="form-control"></textarea>'+
                                        '</div> '+
                                    '</div> '+
                                '</form> '+
                            '</div>'+
                        '</div>',
                buttons:{
                    assign: {
                        label: xwb.lang('btn_submit'),
                        className: "btn-success",
                        callback: function () {
                            $.ajax({
                                url: _args.varReturnRequisitioner,
                                type: "post",
                                data: {
                                    canvass_id:canvass_id,
                                    message:$("#message").val()
                                },
                                success: function(data){
                                    data = $.parseJSON(data);
                                    if(data.status == true){
                                        xwb.Noty(data.message,'success'); 
                                        xwb_var.table_assigned_req.ajax.reload();
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
                        }
                    },
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    },
                }

            });
        },

        /**
        * Delete Item
        *
        * @param int request_id
        *
        * @return mixed
        */
        deleteItem: function (item_id){
                bootbox.dialog({
                title: xwb.lang('modal_delete_item'),
                message: '<div class="row">'+
                            '<form class="form-horizontal">'+
                                '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                    '<div class="form-group">'+
                                        '<label class="col-md-4 control-label" for="message">'+xwb.lang('message_label')+'</label>'+
                                        '<div class="col-md-6">'+
                                            '<textarea name="message" id="message" class="form-control"></textarea>'+
                                        '</div> '+
                                    '</div> '+
                                '</div>'+
                            '</form>'+
                        '</div>',
                buttons:{
                    assign: {
                        label: xwb.lang('btn_delete'),
                        className: "btn-danger",
                        callback: function () {
                            $.ajax({
                                url: _args.varRemoveItem,
                                type: "post",
                                data: {
                                    item_id:item_id,
                                    message:$("#message").val(),
                                },
                                success: function(data){
                                    data = $.parseJSON(data);
                                    if(data.status == true){
                                        xwb.Noty(data.message,'success'); 
                                         
                                        table_req_items.ajax.reload();
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
                    },
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    },
                }

            });


        },

        /**
         * View total amount per supplier
         * 
         * @param  {Number} canvass_id [Request ID]
         * @return null
         */
        supplierSummary: function (canvass_id){
            bootbox.dialog({
                title: xwb.lang('modal_total_supplier'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<div class="table-responsive">'+
                                    '<table class="table table-total-per-supplier">'+
                                        '<thead>'+
                                            '<tr>'+
                                                '<th>'+xwb.lang('lbl_supplier_name')+'</th>'+
                                                '<th>'+xwb.lang('dt_total_label')+'</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody>'+
                                        '</tbody>'+
                                        '<tfoot>'+
                                        '</tfoot>'+
                                    '<table>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
                buttons:{
                    cancel: {
                        label: xwb.lang('btn_close'),
                        className: "btn-warning",
                        callback: function () {

                        }
                    }
                }

            }).init(function(){
               total_per_supplier = $('.table-total-per-supplier').DataTable({
                    "ajax": {
                        "url": _args.varSupplierSummary,
                        "data": function ( d ) {
                            d.canvass_id = canvass_id;
                        },
                        "dataSrc": function (json) {
                        $(".table-total-per-supplier tfoot").html(json.footer);
                        return json.data;
                        },
                      },
                      "order": [[ 0, "desc" ]]
                }); 
            });

        },




    });


    var xwb_var = library(window.jQuery, window, document);
    return func;
}(function($, window, document) {
    "use strict";
    var _args = window.xwb_var;


    $(function() {
        /**
        *generate canvasser assigned request datatable
        *
        *
        */
        _args.table_assigned_req = $('.table_assigned_req').DataTable({
            "processing": false, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [[ 0, "desc" ]], //Initial no order.
            "ajax": {
                "url": _args.varGetAssignedRequest,
                "data": function ( d ) {
                    //d.extra_search = $('#extra').val();
                }
              },
            "columnDefs": [
                { 
                    "targets": [ 4,6 ], 
                    "orderable": false, //set not orderable
                },
            ],
            "createdRow": function( row, data, dataIndex ) {
                if($(row).find('li.has-action').length != 0){
                    $(row).css('background-color','#dff0d8');
                }
                
            }
        });


        $(document).ajaxStart(function() {
            $("div.loader").show();
        }).ajaxStop(function() {
            $("div.loader").hide();
        });

    });
    return _args;
}));
