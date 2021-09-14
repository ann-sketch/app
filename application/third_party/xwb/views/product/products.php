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
                    <table class="table table-striped table_products">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo lang('lbl_name'); ?></th>
                          <th><?php echo lang('dt_heading_category'); ?></th>
                          <th><?php echo lang('dt_action'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a class="<?php echo $demo_disable; ?> btn btn-info xwb-add-product"><?php echo lang('btn_add_product'); ?></a>
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetProduct = '<?php echo base_url('product/getProducts'); ?>';
    xwb_var.varAddProduct = '<?php echo base_url('product/addProduct'); ?>';
    xwb_var.varDeleteProduct = '<?php echo base_url('product/deleteProduct'); ?>';
    xwb_var.varEditProduct = '<?php echo base_url('product/editProduct'); ?>';
    xwb_var.varUpdateProduct = '<?php echo base_url('product/updateProduct'); ?>';
    


<?php
$category = '<option value="0">--'.lang('lbl_no_category').'--</option>';
foreach ($categories as $key => $value) {
    $category .= '<option value="'.$value->id.'">'.$value->description.'</option>';
    $child_cat = child_category($value->id);
    if ($child_cat->num_rows()>0) {
        foreach ($child_cat->result() as $cKey => $cValue) {
            $category .= '<option value="'.$cValue->id.'"> --'.$cValue->description.'</option>';
        }
    }
}
?>
xwb_var.category = '<?php echo $category; ?>';
</script>