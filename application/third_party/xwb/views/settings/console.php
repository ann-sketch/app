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
                <form class="form-horizontal" id="form_settings" name="form_settings" action="<?php echo base_url("settings/saveSettings") ?>" enctype="multipart/form-data">
                    <a href="javascript:;" class="btn btn-warning" onClick="xwb.startPOIncrement()"><?php echo lang('btn_set_postart'); ?></a>
                    <a href="javascript:;" class="btn btn-warning" onClick="xwb.startPRIncrement()"><?php echo lang('btn_set_prstart'); ?></a>
                    <?php if($purchasing_version != $this->purchasing_version): ?>
                        <a href="javascript:;" class="btn btn-info" onClick="xwb.updateDatabase(this)"><?php echo $btnTextUpdate; ?></a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="panel-footer">
                
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>
<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varStartPRIncrement = '<?php echo base_url('settings/startPRIncrement'); ?>';
    xwb_var.varStartPOIncrement = '<?php echo base_url('settings/startPOIncrement'); ?>';
    xwb_var.varUpdateDatabase = '<?php echo base_url('settings/updateDatabase'); ?>';
</script>
