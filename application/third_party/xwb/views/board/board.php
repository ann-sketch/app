<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="loader"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $page_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table_board_approval">
                      <thead>
                        <tr>
                          <th><?php echo lang('dt_heading_pr_num'); ?></th>
                          <th><?php echo lang('dt_heading_request_type'); ?></th>
                          <th><?php echo lang('dt_heading_user'); ?></th>
                          <th><?php echo lang('dt_items'); ?></th>
                          <th><?php echo lang('dt_heading_totalprice'); ?></th>
                          <th><?php echo lang('dt_date_needed'); ?></th>
                          <th><?php echo lang('dt_heading_initiator_note'); ?></th>
                          <th><?php echo lang('dt_heading_board_note'); ?></th>
                          <th><?php echo lang('dt_status'); ?></th>
                          <th><?php echo lang('dt_action'); ?></th>
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
    xwb_var.varGetBoardApproval = '<?php echo base_url('board/getBoardApproval'); ?>';
    xwb_var.varGetBudgetApprovaltItems = '<?php echo base_url('budget/getBudgetApprovaltItems'); ?>';
  xwb_var.varDenyRequest  = '<?php echo base_url('board/denyRequest'); ?>';
  xwb_var.varApproveBoard= '<?php echo base_url('board/approveBoard'); ?>';
</script>
