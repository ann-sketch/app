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
                    <table class="table table_history">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('dt_heading_user'); ?></th>
                                <th><?php echo lang('dt_heading_request_type'); ?></th>
                                <th><?php echo lang('dt_heading_item_description'); ?></th>
                                <!-- <th>Status</th> -->
                                <th><?php echo lang('dt_heading_dateupdated'); ?></th>
                            </tr>
                        </thead>
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
    xwb_var.varGetHistory = '<?php echo base_url('history/getHistory'); ?>';

</script>
