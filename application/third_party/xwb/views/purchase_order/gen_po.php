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
                <form class="form-horizontal" name="form_po" id="form_po">
                    <input type="hidden" name="id" name="id" id="id" />
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="supplier"><?php echo lang('supplier_label'); ?>: <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="supplier" id="supplier" style="width:100%;">
                                            <option value=""><?php echo lang('select_supplier_label'); ?></option>
                                        <?php foreach ($supplier as $k => $v) : ?>
                                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="date_issue"><?php echo lang('date_label'); ?>: <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input id="date_issue" name="date_issue" required="required" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="delivery_date"><?php echo lang('delivery_date_label'); ?>: 
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input id="delivery_date" name="delivery_date" required="required" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="po_num"><?php echo lang('po_num_label'); ?>: <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                  <input id="po_num" name="po_num" required="required" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="pr_number"><?php echo lang('pr_num_label'); ?>: <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                  <input id="pr_number" name="pr_number" required="required" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="rr_num"><?php echo lang('rr_num_label'); ?>: 
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input id="rr_num" name="rr_num" required="required" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="supplier_invoice"><?php echo lang('supplier_invoice_label'); ?>:
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input id="supplier_invoice" name="supplier_invoice" required="required" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="payment_terms"><?php echo lang('payment_terms_label'); ?> <span class="required">*</span>:
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="payment_terms" id="payment_terms" class="form-control">
                                        <option value=""><?php echo lang('select_option'); ?></option>
                                        <option value="cash"><?php echo lang('lbl_cash'); ?></option>
                                        <option value="open_account"><?php echo lang('lbl_open_account'); ?></option>
                                        <option value="secured_account"><?php echo lang('lbl_secured_account'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="warranty_condition"><?php echo lang('warranty_condition_label'); ?> <span class="required">*</span>:
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="warranty_condition" id="warranty_condition" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="supplier_invoice"><?php echo lang('penalty_clause_label'); ?>:
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <p class=""><?php echo getConfig('penalty_clause');?></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr />
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action table_po_items">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('dt_heading_item_name');?></th>
                                        <th><?php echo lang('dt_heading_item_description');?></th>
                                        <th><?php echo lang('dt_heading_quantity');?></th>
                                        <th><?php echo lang('dt_heading_price');?></th>
                                        <th><?php echo lang('dt_heading_amount');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" align="right"><strong><?php echo lang('dt_total_label');?>:</strong></td>
                                        <td><strong class="total_amount">0</strong>
                                        <input type="hidden" value="0" name="total_amount" id="total_amount" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="requisitioner"><?php echo lang('initiator_label');?>:
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <!-- <input id="requisitioner" name="requisitioner" readonly value="<?php echo $request->full_name; ?>" required="required" class="form-control" type="text"> -->
                                    <p class="form-control"><?php echo $request->full_name; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="requisitioner"><?php echo lang('approved_by');?>:
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="auditor" id="auditor" class="form-control">
                                        <option value=""><?php echo lang('select_auditor');?></option>
                                        <?php foreach ($auditor as $key => $value) : ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo ucwords($value->first_name." ".$value->last_name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <a href="javascript:;" onClick="xwb.updatePO()" class="btn btn-info po_update"><?php echo lang('btn_update');?></a>
                <a href="" target="_blank" class="btn btn-success disabled preview_po"><?php echo lang('btn_preview_po');?></a>
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.vaGetPOItems = '<?php echo base_url('purchase_order/getPOItems'); ?>';
    xwb_var.varUpdatePO = '<?php echo base_url('purchase_order/updatePO'); ?>';
    xwb_var.varGetPOBySupplier = '<?php echo base_url('purchase_order/getPOBySupplier'); ?>';
    xwb_var.request_id = <?php echo $request_id; ?>;

</script>
