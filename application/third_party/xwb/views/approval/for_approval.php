<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="loader"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $page_title; ?></h3>
              <em class="text-danger"><?php echo lang('head_heading_info'); ?></em>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table_forapproval_request">
                      <thead>
                        <tr>
                          <th><?php echo lang('dt_heading_pr_num'); ?></th>
                          <th><?php echo lang('dt_heading_request_type'); ?></th>
                          <th><?php echo lang('dt_date_requested'); ?></th>
                          <th><?php echo lang('dt_heading_user'); ?></th>
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

            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    
    xwb_var.varGetReqForApproval = '<?php echo base_url('approval/getReqForApproval'); ?>';
    xwb_var.varGetReqApprovaltItems = '<?php echo base_url('approval/getReqApprovaltItems'); ?>';
    xwb_var.varApproveToPurchasing = '<?php echo base_url('request/approveToPurchasing'); ?>';
    xwb_var.varApproveItem = '<?php echo base_url('approval/approveItem'); ?>';
    xwb_var.varApproveAllItem = '<?php echo base_url('approval/approveAllItem'); ?>';
    xwb_var.varDenyItem = '<?php echo base_url('approval/denyItem'); ?>';
    xwb_var.varRemoveAttachment = '<?php echo base_url('attachment/removeAttachment'); ?>';

    xwb_var.varGetAttachment = '<?php echo base_url('attachment/getAttachment'); ?>';
</script>