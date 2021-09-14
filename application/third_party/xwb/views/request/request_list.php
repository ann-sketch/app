<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="loader"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_title; ?></h3>
                <em class="text-danger"><?php echo lang('request_list_heading_info'); ?></em>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table_request_list">
                      <thead>
                        <tr>
                          <th><?php echo lang('dt_heading_pr_num'); ?></th>
                          <th><?php echo lang('dt_heading_request_type'); ?></th>
                          <th><?php echo lang('dt_date_requested'); ?></th>
                          <th><?php echo lang('dt_heading_user'); ?></th>
                          <th><?php echo lang('dt_heading_department'); ?></th>
                          <th><?php echo lang('dt_heading_branch'); ?></th>
                          <th><?php echo lang('dt_purpose'); ?></th>
                          <th><?php echo lang('dt_items'); ?></th>
                          <th><?php echo lang('dt_date_needed'); ?></th>
                          <th><?php echo lang('dt_action'); ?></th>
                          <th><?php echo lang('dt_status'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="<?php echo base_url('request/newreq'); ?>" class="btn btn-info"><?php echo lang('btn_newreq'); ?></a>
            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url($this->config->item('assets_folder').'js/jquery.form.js'); ?>"></script>
<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetRequest = '<?php echo base_url('request/getAdminRequest'); ?>';
    xwb_var.varGetRequestItems = '<?php echo base_url('request/getRequestItems'); ?>';
    xwb_var.varAssignCanvasser = '<?php echo base_url('request/assignCanvasser'); ?>';
    xwb_var.varDenyRequest = '<?php echo base_url('request/denyRequest'); ?>';
    xwb_var.varGetAttachment = '<?php echo base_url('attachment/getAttachment'); ?>';
    xwb_var.varAddAttachment = '<?php echo base_url('attachment/addAttachment'); ?>';
    xwb_var.varMarkDone = '<?php echo base_url('request/markDone'); ?>';
    xwb_var.varRemoveAttachment = '<?php echo base_url('attachment/removeAttachment'); ?>';
    xwb_var.varSetExpenditure = '<?php echo base_url('request/setExpenditure'); ?>';
    xwb_var.varSetExpenditureItem = '<?php echo base_url('request/setExpenditureItem'); ?>';
    xwb_var.varReturnCanvass = '<?php echo base_url('request/returnCanvass'); ?>';
    xwb_var.varGetResponse = '<?php echo base_url('request/getResponse'); ?>';
    xwb_var.varAssignBudget = '<?php echo base_url('request/assignBudget'); ?>';
    xwb_var.varGetBudgetMsg = '<?php echo base_url('request/getBudgetMsg'); ?>';
    xwb_var.varGetReqMsg = '<?php echo base_url('request/getReqMsg'); ?>';
    xwb_var.varReturnBudget = '<?php echo base_url('request/returnBudget'); ?>';
    xwb_var.varRemoveItem = '<?php echo base_url('request/removeItem'); ?>';
    xwb_var.varReturnRequest = '<?php echo base_url('request/returnRequest'); ?>';
    xwb_var.varGetItemDone = '<?php echo base_url('request/getItemDone'); ?>';
    xwb_var.varArchiveRequest = '<?php echo base_url('request/archiveRequest'); ?>';
    xwb_var.varSupplierSummary = '<?php echo base_url('canvasser/supplierSummary'); ?>';
    <?php
    $canvasserHTML = "<option>".lang('select_user')."</option>";
    foreach ($canvasser as $key => $value) {
        $canvasserHTML .= '<option value="'.$value->id.'">'.ucwords($value->first_name." ".$value->last_name).'</option>';
    }
    ?>
    xwb_var.canvasserOptions = '<?php echo $canvasserHTML; ?>';

    <?php
    $req_cat_opt = "<option value=\'\'>".lang('select_req_cat')."</option>";
    foreach ($req_cat as $key => $value) {
        $req_cat_opt .= '<option value="'.$value->id.'">'.$value->description.'</option>';
    }
    ?>
    xwb_var.req_cat_opt = '<?php echo $req_cat_opt; ?>';


    <?php
    $BDUsersOptions = "<option value=\'\'>".lang('select_req_cat')."</option>";
    foreach ($budget_users as $key => $value) {
        $BDUsersOptions .= '<option value="'.$value->id.'">'.ucwords($value->first_name." ".$value->last_name).'</option>';
    }
    ?>
    xwb_var.BDUsersOptions = '<?php echo $BDUsersOptions; ?>';

</script>
