///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// Request Approval Script goes here //
///////////////////////////////////////
var xwb = (function(library) {
    "use strict";
    var func = function (){};
    var $ = window.jQuery;
    var xwb = window.xwb;
    var _args = window.xwb_var;
    var bootbox = window.bootbox;

    var table_req_items;

    $.extend(func, {
        /**
        * Deny request
        * @param int budgetapproval_id
        *
        * @return mixed
        */
        deny: function (budgetapproval_id){
            bootbox.dialog({
                title: xwb.lang('modal_deny_req'),
                message: '<div class="row">'+
                            '<div class="col-md-12 col-sm-12 col-xs-12">'+
                                '<div class="form-group">'+
                                    '<label class="col-md-4 control-label" for="reason">'+xwb.lang('label_reason')+'</label>'+
                                    '<div class="col-md-6">'+
                                        '<textarea name="reason" id="reason" class="form-control"></textarea>'+
                                    '</div> '+
                                '</div> '+
                            '</div>'+
                        '</div>',
                buttons:{
                    deny: {
                        label: xwb.lang('btn_deny'),
                        className: "btn-success",
                        callback: function () {
                            $.ajax({
                                url: _args.varDenyRequest,
                                type: "post",
                                data: {
                                    budgetapproval_id:budgetapproval_id,
                                    reason:$("#reason").val()
                                },
                                success: function(data){
                                    data = $.parseJSON(data);
                                    if(data.status == true){
                                        xwb.Noty(data.message,'success');
                                        xwb_var.table_budgetreq_approval.ajax.reload();
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

        },

        /**
        * View Items
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
                                                '<th>'+xwb.lang('lbl_item')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_item_description')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_quantity')+'</th>'+
                                                expenditure+
                                                qty_price+
                                                '<th>'+xwb.lang('dt_heading_price')+'</th>'+
                                                '<th>'+xwb.lang('dt_heading_totalprice')+'</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody>'+
                                    '<table>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
                className: "width-90p",
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
                        "url": _args.varGetBudgetApprovaltItems,
                        "data": function ( d ) {
                            d.request_id = request_id;
                        }
                    },
                    "order": [[ 0, "desc" ]]
                });
            });

            
        },


        /**
        * Approve request
        * @param int budget_id
        *
        * @return mixed
        */
        approve: function (budget_id){
           bootbox.confirm(xwb.lang('msg_budget_approve_request').replace('%s',_args.forBoardApprovalAmount), function(result){ 
                if(result){
                    $.ajax({
                        url: _args.varApproveBudget,
                        type: "post",
                        data: {
                            'budget_id':budget_id
                        },
                        success: function(data){
                            data = $.parseJSON(data);
                            if(data.status == true){
                                xwb.Noty(data.message,'success'); 
                                 
                                xwb_var.table_budgetreq_approval.ajax.reload();
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
        },


        /**
        * View message and response
        *
        * @param int budget_id
        *
        * @return mixed
        */
        view_response: function (budget_id){
            $.ajax({
                url: _args.varGetBudgetMessage,
                type: "get",
                data: {
                    budget_id:budget_id,
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
                                                '<textarea name="reason" readonly id="reason" class="form-control">'+data.message+'</textarea>'+
                                            '</div> '+
                                        '</div> '+
                                        '</form> '+
                                    '</div>'+
                                '</div>',
                        buttons:{
                            approve: {
                                label: xwb.lang('btn_approve'),
                                className: "btn-success",
                                callback: function () {
                                    func.approve(budget_id);
                                }
                            },
                            deny: {
                                label: xwb.lang('btn_deny'),
                                className: "btn-danger",
                                callback: function () {
                                    func.deny(budget_id);
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

    });

    var xwb_var = library(window.jQuery, window, document);
    return func;
}(function($, window, document) {
    "use strict";
    var _args = window.xwb_var;
    var xwb = window.xwb;

    $(function() {


        /**
        *generate request list datatable
        *
        *
        */
        _args.table_budgetreq_approval = $('.table_budgetreq_approval').DataTable({
            "processing": false, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [[ 0, "desc" ]], //Initial no order.
            "ajax": {
                "url": _args.varGetBudgetRequestApproval,
                "data": function ( d ) {
                    //d.extra_search = $('#extra').val();
                }
            },
            "columnDefs": [
                { 
                    "targets": [ 3,6 ], 
                    "orderable": false, //set not orderable
                },
            ],
              "createdRow": function( row, data, dataIndex ) {
                if($(row).find('li.has-action').length != 0){
                    $(row).css('background-color','#dff0d8');
                }
                
              }
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
                         
                        _args.table_budgetreq_approval.ajax.reload();
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



        $(document).ajaxStart(function() {
            $("div.loader").show();
        }).ajaxStop(function() {
            $("div.loader").hide();
        });

    });
    return _args;
}));
