<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $page_title; ?> </h3>
              <span class="text-danger"><?php echo lang('page_status_info'); ?> </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">

                    <table class="table table-status">
                        <thead>
                            <tr>
                                <th><?php echo lang('dt_status_name'); ?></th>
                                <th><?php echo lang('dt_status_num'); ?></th>
                                <th><?php echo lang('dt_status_txt'); ?></th>
                                <th><?php echo lang('dt_status_type'); ?></th>
                                <th><?php echo lang('dt_action'); ?></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="" class="<?php echo $demo_disable; ?> btn btn-info xwb-add-status"><?php echo lang('btn_add_status'); ?></a>
            </div>
        </div>

    </div>
</div>


<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varAddStatus = '<?php echo base_url('settings/addStatus'); ?>';
    xwb_var.varGetStatus = '<?php echo base_url('settings/getStatus'); ?>';
    xwb_var.varEditStatus = '<?php echo base_url('settings/editStatus'); ?>';
    xwb_var.varUpdateStatus = '<?php echo base_url('settings/updateStatus'); ?>';
    xwb_var.varDeleteStatus = '<?php echo base_url('settings/deleteStatus'); ?>';

    //user group option list
    <?php
        $status_opt = '<select class="form-control" name="status_name" id="status-names"  style="width:100%;">';
    foreach ($status_names as $key => $value) {
        $status_opt .= '<option value="'.$value.'">'.$value.'</option>';
    }
        $status_opt .= '</select>';
    ?>
    xwb_var.status_names = '<?php echo $status_opt; ?>';


    //user group option list
    <?php
        $status_type_opt = '<select class="form-control status-type" name="status_type" id="status-type">';
    foreach ($status_types as $key => $value) {
        $status_type_opt .= '<option class="label label-'.$value.'" value="'.$value.'">'.$value.'</option>';
    }
        $status_type_opt .= '</select>';
    ?>
    xwb_var.status_types = '<?php echo $status_type_opt; ?>';


</script>
