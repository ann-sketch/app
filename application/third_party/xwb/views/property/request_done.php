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
                    <table class="table table-striped table_request_done">
                      <thead>
                        <tr>
                            <th><?php echo lang('dt_heading_pr_num'); ?></th>
                            <th><?php echo lang('dt_heading_po_num'); ?></th>
                            <th><?php echo lang('dt_heading_request_type'); ?></th>
                            <th><?php echo lang('dt_heading_user'); ?></th>
                            <th><?php echo lang('dt_heading_department'); ?></th>
                            <th><?php echo lang('dt_heading_branch'); ?></th>
                            <th><?php echo lang('dt_purpose'); ?></th>
                            <th><?php echo lang('dt_date_needed'); ?></th>
                            <th><?php echo lang('dt_heading_eta'); ?></th>
                            <th><?php echo lang('lbl_date_received'); ?></th>
                            <th><?php echo lang('remarks_label'); ?></th>
                            <th><?php echo lang('dt_items'); ?></th>
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
xwb_var.varGetProperties = '<?php echo base_url('property/getProperties'); ?>';
xwb_var.varReceivedItems = '<?php echo base_url('property/receivedItems'); ?>';
xwb_var.varGetPropertyItems = '<?php echo base_url('property/getPropertyItems'); ?>';
</script>