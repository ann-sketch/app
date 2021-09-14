<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="loader"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $page_title; ?> <span class="pull-right"><?php echo lang('php_version'); ?>: <?php echo (float)phpversion(); ?></span></h3>
            </div>
            <div class="panel-body">
                <form method="POST" class="form-horizontal" id="xwb-form-settings" name="form_settings" action="<?php echo base_url("settings/saveSettings") ?>" enctype="multipart/form-data">
                <h3><?php echo lang('headig_company_profile'); ?></h3>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"><?php echo lang('label_upload_logo'); ?> :</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
                            <div id='preview' class="center" style="max-height: 300px;">
                            <img src="<?php echo base_url('image?path='.getConfig('logo')); ?>" alt="<?php echo getConfig('logo'); ?>" class="img-responsive" id="company_logo">
                            </div>
                            <input type="file" name="logo" id="logo" accept="image/*" />
                            <hr />
                            <code class="help"><?php echo lang('upload_logo_help'); ?></code>
                            <hr />
                            <p class="error"><?php echo lang('upload_logo_instruction'); ?> <br /><strong><?php echo lang('text_example'); ?></strong>:<code><?php echo lang('upload_logo_command'); ?></code></p>
                            <hr />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name"><?php echo lang('lbl_company_name'); ?> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="company_name" name="company_name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('company_name'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_address"><?php echo lang('lbl_company_address'); ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="company_address" name="company_address" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('company_address'); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_phone"><?php echo lang('lbl_company_phone'); ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="company_phone" name="company_phone" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('company_phone'); ?>">
                        </div>
                    </div>
                    <hr />
<h3><?php echo lang('po_page_title'); ?> </h3><em class="text-danger"><?php echo lang('settings_po_info'); ?></em>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="penalty_clause"><?php echo lang('lbl_po_penalty_clause'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="penalty_clause" id="penalty_clause" class="form-control"><?php echo getConfig('penalty_clause'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PO_note"><?php echo lang('lbl_po_note'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="PO_note" id="PO_note" class="form-control"><?php echo getConfig('PO_note'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PO_reminder"><?php echo lang('lbl_po_reminder'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="PO_reminder" id="PO_reminder" class="form-control"><?php echo getConfig('PO_reminder'); ?></textarea>
                        </div>
                    </div>
                    <hr />
<h3><?php echo lang('heading_print_req'); ?></h3><em class="text-danger"><?php echo lang('settings_printreq_info'); ?></em>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="with_budget"><?php echo lang('pdf_with_budget'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="with_budget" name="with_budget" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('with_budget'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_certified_by"><?php echo lang('pdf_budget_certified_by'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="budget_certified_by" name="budget_certified_by" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('budget_certified_by'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="approve_purchased_by"><?php echo lang('pdf_approve_purchased_by'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="approve_purchased_by" name="approve_purchased_by" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('approve_purchased_by'); ?>">
                        </div>
                    </div>
                    <hr />
                    <h3><?php echo lang('dashboard_page_title'); ?></h3>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="announcement"><?php echo lang('lbl_announcement'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="announcement" id="announcement" class="form-control"><?php echo getConfig('announcement'); ?></textarea>
                        </div>
                    </div>

                    <hr />
                    <h3><?php echo lang('dashboard_miscellaneous'); ?></h3>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="approve_purchased_by"><?php echo lang('lbl_board_approval_amount'); ?>: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="board_approval_amount" name="board_approval_amount" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo getConfig('board_approval_amount'); ?>">
                          <span class="help"><?php echo lang('lbl_board_approval_amount_info'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_phone"><?php echo lang('lbl_logo_to_use'); ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="radio">
                            <label>
                              <input type="radio" value="logo" name="logo_to_use" <?php echo (getConfig('logo_to_use')=='logo'?'checked':'') ?> /> <?php echo lang('text_logo'); ?>
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" value="company_name" name="logo_to_use" <?php echo (getConfig('logo_to_use')=='company_name'?'checked':'') ?>> <?php echo lang('text_company_name'); ?>
                            </label>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_phone"><?php echo lang('lbl_show_default_user'); ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="radio">
                            <label>
                              <input type="radio" value="1" name="login_default_users" <?php echo (getConfig('login_default_users')=='1'?'checked':'') ?>> Yes
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" value="" name="login_default_users" <?php echo (getConfig('login_default_users')==''?'checked':'') ?>> No
                            </label>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_notification"><?php echo lang('lbl_email_notif'); ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="radio">
                            <label>
                              <input type="radio" value="1" name="email_notification" <?php echo (getConfig('email_notification')=='1'?'checked':'') ?>> <?php echo lang('txt_enabled'); ?>
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" value="" name="email_notification" <?php echo (getConfig('email_notification')==''?'checked':'') ?>> <?php echo lang('txt_disabled'); ?> 
                            </label>
                          </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">
                <a class="btn btn-info xwb-update-settings <?php echo $demo_disable; ?>"><?php echo lang('btn_update'); ?> </a>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>
<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    var xwb_var = {};
    xwb_var.varUpdateSettings = '<?php echo base_url('settings/updateSettings'); ?>';
    xwb_var.imgLoading = '<?php echo base_url('assets/images/loader.gif'); ?>';
</script>
