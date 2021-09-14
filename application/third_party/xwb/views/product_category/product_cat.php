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
                    <table class="table table-striped table_product_cat">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('lbl_name'); ?></th>
                            <th><?php echo lang('lbl_description'); ?></th>
                            <th><?php echo lang('lbl_parent_cat'); ?></th>
                            <th><?php echo lang('dt_action'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="" class="<?php echo $demo_disable; ?> btn btn-info xwb-add-prodcat"><?php echo lang('btn_add'); ?></a>
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetProdCat = '<?php echo base_url('product_category/getProdCat'); ?>';
    xwb_var.varAddProdCat = '<?php echo base_url('product_category/addProdCat'); ?>';
    xwb_var.varDeleteProdCat = '<?php echo base_url('product_category/deleteProdCat'); ?>';
    xwb_var.varEditProdCat = '<?php echo base_url('product_category/editProdCat'); ?>';
    xwb_var.varUpdateProdCat = '<?php echo base_url('product_category/updateProdCat'); ?>';
    


<?php
$parentCat = '<option value="0">--'.lang('lbl_parent_cat').'--</option>';
foreach ($parent_cat as $key => $value) {
    $parentCat .= '<option value="'.$value->id.'">'.$value->description.'</option>';
}
?>
xwb_var.parentCat = '<?php echo $parentCat; ?>';
</script>