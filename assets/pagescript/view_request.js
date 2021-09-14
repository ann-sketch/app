///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2017, Jay-r Simpron //
//                                   //
// View Request Script goes here     //
///////////////////////////////////////
var xwb = (function(library) {
	"use strict";
    var func = function (){};
    var $ = window.jQuery;
    var _args = window.xwb_var;
    var xwb = window.xwb;
    var bootbox = window.bootbox;

    var table_denied_items;

    $.extend(func, {


		/**
		* View reson and response
		*
		* @param int request_id
		*
		* @return mixed
		*/
		view_response: function (request_id){
			$.ajax({
			    url: _args.varGetDeniedReason,
			    type: "post",
			    data: {
			        request_id:request_id,
			    },
			    success: function(data){
			        data = $.parseJSON(data);
			        bootbox.dialog({
				        title: xwb.lang('modal_reason_response'),
				        message: '<div class="row">'+
				                    '<div class="col-md-12 col-sm-12 col-xs-12">'+
				                    	'<form class="form-horizontal">'+
			                    		'<div class="form-group">'+
				                            '<label class="col-md-4 control-label" for="reason">'+xwb.lang('message_label')+':</label>'+
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
				                label: xwb.lang('btn_submit'),
				                className: "btn-success",
				                callback: function () {
				                    $.ajax({
				                        url: _args.varRespond,
				                        type: "post",
				                        data: {
				                            request_id:request_id,
				                            response:$("#response").val()
				                        },
				                        success: function(data){
				                            data = $.parseJSON(data);
				                            if(data.status == true){
				                                xwb.Noty(data.message,'success'); 
				                                location.reload();
			                                
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
		* View reason No Response
		*
		* @param int request_id
		*
		* @return mixed
		*/
		view_res: function (request_id){
			$.ajax({
			    url: _args.varGetDeniedReason,
			    type: "post",
			    data: {
			        request_id:request_id,
			    },
			    success: function(data){
			        data = $.parseJSON(data);
			        bootbox.dialog({
				        title: xwb.lang('modal_reason_response'),
				        message: '<div class="row">'+
				                    '<div class="col-md-12 col-sm-12 col-xs-12">'+
				                    	'<form class="form-horizontal">'+
			                    		'<div class="form-group">'+
				                            '<label class="col-md-4 control-label" for="reason">'+xwb.lang('message_label')+':</label>'+
				                            '<div class="col-md-6">'+
				                                '<textarea name="reason" readonly id="reason" class="form-control">'+data.reason+'</textarea>'+
				                            '</div> '+
				                        '</div> '+
				                        '</form> '+
				                    '</div>'+
				                '</div>',
				        buttons:{
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
		* View denied Items
		* @param int request_id
		*
		* @return mixed
		*/
		viewItemsDenied : function (request_id){
		    bootbox.dialog({
		        title: xwb.lang('modal_title_denied_items'),
		        message: '<div class="row">'+
		                    '<div class="col-md-12 col-sm-12 col-xs-12">'+
		                        '<div class="table-responsive">'+
		                            '<table class="table table_denied_items">'+
		                                '<thead>'+
		                                    '<tr>'+
		                                        '<th>'+xwb.lang('dt_heading_item_name')+'</th>'+
		                                        '<th>'+xwb.lang('dt_heading_item_description')+'</th>'+
		                                        '<th>'+xwb.lang('dt_heading_quantity')+'</th>'+
		                                        '<th>'+xwb.lang('dt_heading_assigned_to')+'</th>'+
		                                        '<th>'+xwb.lang('dt_heading_status')+'</th>'+
		                                        '<th>'+xwb.lang('dt_heading_officers_note')+'</th>'+
		                                        '<th>'+xwb.lang('dt_heading_initiator_note')+'</th>'+
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
		    	table_denied_items = $('.table_denied_items').DataTable({
		        "ajax": {
		            "url": _args.varGetDeniedItems,
		            "data": function ( d ) {
		                d.request_id = request_id;
		            }
		          	},
		          	"order": [[ 0, "desc" ]]
		    	});
		    });

		    
		},


		/**
		* Respond to head department
		*
		* @param int approval_id
		*
		* @return mixed
		*/
		respondToHead: function (approval_id){
			$.ajax({
		        url: _args.varRespondToHead,
		        type: "post",
		        data: {
		            approval_id:approval_id,
		            response:$(".requestor_note_"+approval_id).val()
		        },
		        success: function(data){
		            data = $.parseJSON(data);
		            if(data.status == true){
		                xwb.Noty(data.message,'success'); 
		                table_denied_items.ajax.reload();
						location.reload();
		                
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



    });

    window.func = func;

    library(window.jQuery, window, document);
    return func;
}(function($, window, document) {
    "use strict";

    /**
     * Jquery Functions goes here
     * 
     */
    $(function() {

		$(document).ajaxStart(function() {
		    $("div.loader").show();
		}).ajaxStop(function() {
		    $("div.loader").hide();
		});

 	});

}));
