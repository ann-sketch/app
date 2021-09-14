///////////////////////////////////////
// XWB Purchasing                    //
// Author - Jay-r Simpron            //
// Copyright (c) 2019, Jay-r Simpron //
//                                   //
// Users JavaScripts goes here       //
///////////////////////////////////////
(function(library) {
    "use strict";
    library(window.jQuery, window, document);

}(function($, window, document) {
    "use strict";
    var _args = window.xwb_var;
    var bootbox = window.bootbox;
    var xwb = window.xwb;
    

    /**
     * Jquery functions goes here
     * 
     */
    $(function() {

        /**
        * Change password
        *
        *
        * @return void
        */
        $.fn.changePass = function (row,key){
            $( document ).delegate( '.xwb-change-pass', "click", function(e){
                e.preventDefault();
                e.stopPropagation();

                var oldPass = $(this).closest('.input-group').find('input').val();
                console.log(oldPass);

                $.ajax({
                    url: _args.varCheckPass,
                    type: "post",
                    data: {
                        password:oldPass
                    },
                    success: function(data){
                        data = $.parseJSON(data);
                        if(data.status == true){
                            bootbox.dialog({
                                title: xwb.lang('modal_change_password'),
                                message: '<div class="row">  ' +
                                    '<div class="col-md-12 col-sm-12 col-xs-12"> ' +
                                    '<form class="form-horizontal" name="form_change_pass" id="form_change_pass"> ' +
                                        '<input type="hidden" id="old_password" name="old_password" value="'+data.old_password+'" />'+
                                        '<input type="hidden" id="id" name="id" value="'+data.user_id+'" />'+
                                        '<div class="form-group"> ' +
                                            '<label class="col-md-4 control-label" for="new_password">'+xwb.lang('lbl_new_pass')+'</label> ' +
                                            '<div class="col-md-6"> ' +
                                                '<input id="new_password" name="new_password" type="password" placeholder="'+xwb.lang('lbl_new_pass')+'" class="form-control input-md"> ' +
                                            '</div> ' +
                                        '</div> ' +
                                        '<div class="form-group"> ' +
                                            '<label class="col-md-4 control-label" for="confirm_password">'+xwb.lang('lbl_confirm_pass')+'</label> ' +
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




        $(".xwb-change-pass").changePass();


    });
    
}));