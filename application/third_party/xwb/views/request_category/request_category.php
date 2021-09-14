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
                    <table class="table table-striped table_req_cat">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo lang('lbl_name'); ?></th>
                          <th><?php echo lang('lbl_description'); ?></th>
                          <th><?php echo lang('dt_action'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="" class="<?php echo $demo_disable; ?> btn btn-info xwb-add-request-cat"><?php echo lang('btn_add'); ?></a>
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetReqCat = '<?php echo base_url('request_category/getReqCat'); ?>';
    xwb_var.varEditReqCat = '<?php echo base_url('request_category/editReqCat'); ?>';
    xwb_var.varUpdateReqCat = '<?php echo base_url('request_category/updateReqCat'); ?>';
    xwb_var.varAddReqCat = '<?php echo base_url('request_category/addReqCat'); ?>';
    xwb_var.varDeleteReqCat = '<?php echo base_url('request_category/deleteReqCat'); ?>';

</script>