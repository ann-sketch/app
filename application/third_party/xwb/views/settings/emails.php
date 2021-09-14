<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $page_title; ?>  <a href="javascript:;" class="btn btn-xs btn-info xwb-sc-ref"><?php echo lang('txt_shortcode_ref'); ?></a></h3>
              <em class="text-danger"><?php echo lang('email_page_info'); ?></em>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table_process_emails" id="table_process_emails">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('heading_process'); ?></th>
                                <th><?php echo lang('message_label'); ?></th>
                                <th><?php echo lang('dt_heading_action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            foreach ($process as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><strong><?php echo $value; ?></strong></td>
                                    <td><?php echo getMessage($key)['message']; ?></td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs btn-warning xwb-edit-email <?php echo $demo_disable; ?>" data-key="<?php echo $key; ?>"><?php echo lang('btn_edit'); ?></a>
                                    </td>
                                </tr>
                            <?php
                            $counter++;
                            endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url($this->config->item('assets_folder').'vendor/ckeditor/ckeditor/ckeditor.js'); ?>"></script>
<!-- Javascript variable from php for this page here -->
<script type="text/javascript">

xwb_var.varGetEmail = '<?php echo base_url('settings/getEmail'); ?>';
xwb_var.varUpdateEmail = '<?php echo base_url('settings/updateEmail'); ?>';
</script>
