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
                    <table class="table table-striped table_branch">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo lang('lbl_name'); ?></th>
                          <th><?php echo lang('lbl_description'); ?></th>
                          <th><?php echo lang('dt_heading_action'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="" class="<?php echo $demo_disable; ?> btn btn-info xwb-add-branch"><?php echo lang('btn_add_branch'); ?></a>
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetBranch = '<?php echo base_url('branch/getBranch'); ?>';
    xwb_var.varEditBranch = '<?php echo base_url('branch/editBranch'); ?>';
    xwb_var.varUpdateBranch = '<?php echo base_url('branch/updateBranch'); ?>';
    xwb_var.varAddBranch = '<?php echo base_url('branch/addBranch'); ?>';
    xwb_var.varDeleteBranch = '<?php echo base_url('branch/deleteBranch'); ?>';

</script>