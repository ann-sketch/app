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
                <!-- Smart Wizard -->
                <div id="new_request_wizard" class="new_request_wizard">
                    <div id="wizard" class="form_wizard wizard_horizontal wizard">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                <?php echo lang('newreq_step1'); ?><br />
                                <small><?php echo lang('newreq_step1_subheading'); ?></small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                <?php echo lang('newreq_step2'); ?><br />
                                <small><?php echo lang('newreq_step2_subheading'); ?></small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                <?php echo lang('newreq_step3'); ?><br />
                                <small><?php echo lang('newreq_step3_subheading'); ?></small>
                            </span>
                          </a>
                        </li>

                      </ul>
                      <div id="step-1">
                        <form class="form-horizontal form-label-left">

                          <span class="section"><?php echo lang('newreq_step1_subheading'); ?></span>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3" for="request_name"><?php echo lang('reqname_label'); ?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <input type="text" id="request_name" name="request_name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3" for="purpose"><?php echo lang('reqname_purpose'); ?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <input type="text" id="purpose" name="purpose" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="priority_level" class="control-label col-md-3 col-sm-3"><?php echo lang('dt_date_needed'); ?></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" id="date_needed" name="date_needed" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                        </form>
                      </div>
                      <div id="step-2">
                          <form class="form-horizontal form-label-left">
                                <h2 class="StepTitle"><?php echo lang('newreq_step2_subheading'); ?></h2><a class="btn btn-success btn-xs xwb-add-item" href="">
                                                      <i class="fa fa-plus"></i> <?php echo lang('btn_add_item'); ?>
                                                    </a>
                                                    <hr class="clearfix" />
                                <div class="table-responsive">
                                    <table class="table table_items">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('dt_heading_item_name'); ?></th>
                                                <th><?php echo lang('dt_heading_item_description'); ?></th>
                                                <th><?php echo lang('dt_heading_unit'); ?></th>
                                                <th><?php echo lang('dt_heading_quantity'); ?></th>
                                                <th><?php echo lang('dt_heading_action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle"><?php echo lang('newreq_step3_subheading'); ?></h2>
                        <em class="text-danger"><?php echo lang('msg_newreq_verify_info'); ?></em>
                        <hr class="clearfix" />
                        <div class="row">
                            <div class="col-md-12 review_request">
                                
                            </div>
                        </div>
                      </div>


                   </div>
                   <!-- End SmartWizard Content -->

                   <div class="actionBarClone">
                                <a href="javascript:;" class="btn btn-primary pull-right disabled finish"><?php echo lang('btn_file_newreq'); ?></a>
                                <a href="javascript:;" class="btn btn-default pull-right next"><?php echo lang('btn_next'); ?></a>
                                <a href="javascript:;" class="btn btn-default pull-left prev"><?php echo lang('btn_previous'); ?></a>
                        </div>
                    
                    </div>
            </div>

        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script src="<?php echo base_url('assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>

<script type="text/javascript">

xwb_var.varNewRequestSteps = '<?php echo base_url('request/newRequestSteps'); ?>';
xwb_var.varFileRequest = '<?php echo base_url('request/fileRequest'); ?>';
xwb_var.varAddAttachment = '<?php echo base_url('request/addAttachment'); ?>';
xwb_var.varGetAttachment = '<?php echo base_url('request/getAttachment'); ?>';
xwb_var.varRemoveAttachment = '<?php echo base_url('request/removeAttachment'); ?>';
xwb_var.varGetAttachmentPreview = '<?php echo base_url('request/getAttachmentPreview'); ?>';

xwb_var.trcount = 0;
<?php
if ($current_user->group_name=='admin') {
    $req_url = 'request/reqlist';
} else {
    $req_url = 'request';
}
?>
xwb_var.varRequest = '<?php echo base_url($req_url); ?>';


<?php
$prodOptions = '<option value="">'.lang('select_product').'</option>';
foreach ($products as $key => $value) {
    $prodOptions .= '<option value="'.$value->id.'">'.$value->product_name.'</option>';
}
?>
xwb_var.prodOptions = '<?php echo $prodOptions; ?>';


<?php
$unitOptions = '';

foreach ($unit_measurements as $key => $value) {
    $unitOptions .= '<option value="'.$key.'">'.$value.'</option>';
}
?>
xwb_var.unitOptions = '<?php echo $unitOptions; ?>';

xwb_var.tr_to_insert = '<tr>'+
                        '<td>'+
                            '<input type="text" name="item[]" readonly required="required" class="form-control col-md-7 col-xs-12 item">'+
                            '<input type="hidden" name="product_id[]" class="form-control col-md-7 col-xs-12 product_id">'+
                        '</td>'+
                        '<td><textarea name="description[]" class="form-control description"></textarea></td>'+
                        '<td>'+
                        '<select class="unit-measurement" name="unit_measurement[]" style="width:100%;">'+
                        xwb_var.unitOptions+
                        '</select>'+
                        '</td>'+
                        '<td><input type="text" name="qty[]" required="required" class="form-control col-md-7 col-xs-12 qty"></td>'+
                        '<td>'+
                            '<a class="btn btn-danger btn-xs xwb-remove-item" href="">'+
                              '<i class="fa fa-plus"></i> <?php echo lang('btn_remove_item'); ?>'+
                            '</a>'+
                            '<a class="btn btn-info btn-xs xwb-view-attachment" href="">'+
                              '<i class="fa fa-file-image-o"></i> <?php echo lang('btn_attachment'); ?>'+
                            '</a>'+
                        '</td>'+
                    '</tr>';

</script>
