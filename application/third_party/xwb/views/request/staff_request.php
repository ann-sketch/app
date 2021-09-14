<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $page_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table_staff_request">
                      <thead>
                        <tr>
                          <th><?php echo lang('dt_heading_pr_num'); ?></th>
                          <th><?php echo lang('dt_heading_request_type'); ?></th>
                          <th><?php echo lang('dt_heading_user'); ?></th>
                          <th><?php echo lang('dt_date_requested'); ?></th>
                          <th><?php echo lang('dt_purpose'); ?></th>
                          <th><?php echo lang('dt_items'); ?></th>
                          <th><?php echo lang('dt_date_needed'); ?></th>
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

<script src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>
<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetStaffRequest = '<?php echo base_url('request/getStaffRequest'); ?>';
    xwb_var.varGetRequestItems = '<?php echo base_url('request/getRequestItems'); ?>';
    xwb_var.varSetExpenditureItem = '<?php echo base_url('request/setExpenditureItem'); ?>';
    xwb_var.varGetAttachment = '<?php echo base_url('attachment/getAttachment'); ?>';
    xwb_var.varAddAttachment = '<?php echo base_url('attachment/addAttachment'); ?>';
    xwb_var.varRemoveAttachment = '<?php echo base_url('attachment/removeAttachment'); ?>';

</script>
