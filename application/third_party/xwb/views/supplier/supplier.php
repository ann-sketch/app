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
                    <table class="table table-striped table_supplier">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('dt_name'); ?></th>
                            <th><?php echo lang('dt_email'); ?></th>
                            <th><?php echo lang('dt_tel_num'); ?></th>
                            <th><?php echo lang('dt_mobile_num'); ?></th>
                            <th><?php echo lang('dt_fax'); ?></th>
                            <th><?php echo lang('payment_terms_label'); ?></th>
                            <th><?php echo lang('dt_address'); ?></th>
                            <th><?php echo lang('dt_action'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="" class="<?php echo $demo_disable; ?> btn btn-info xwb-add-supplier"><?php echo lang('btn_add_supplier'); ?></a>
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">

    xwb_var.varGetSupplier = '<?php echo base_url('supplier/getSupplier'); ?>';
    xwb_var.varAddSupplier = '<?php echo base_url('supplier/addSupplier'); ?>';
    xwb_var.varEditSupplier = '<?php echo base_url('supplier/editSupplier'); ?>';
    xwb_var.varUpdateSupplier = '<?php echo base_url('supplier/updateSupplier'); ?>';
    xwb_var.varDeleteSupplier = '<?php echo base_url('supplier/deleteSupplier'); ?>';
    
</script>