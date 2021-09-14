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
                <form class="form-horizontal" accept-charset="utf-8">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('label_year'); ?>: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control search_opt" name="year" id="year">
                                <option value=""><?php echo lang('label_all'); ?></option>
                                <?php foreach (range(date('Y'), 2000) as $key => $value) : ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('label_month'); ?>: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control search_opt" name="month" id="month">
                                <option value=""><?php echo lang('label_all'); ?></option>
                                <?php foreach (range(1, 12) as $key => $value) : ?>
                                    <option value="<?php echo $value; ?>"><?php echo date('F', strtotime(date('Y').'-'.$value.'-'.date('d'))); ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                    </div>
                    
                </form>
                   <hr />
                <div class="table-responsive">
                    <table class="table table-striped table-hover table_items_report">
                      <thead>
                        <tr>
                            <th><?php echo lang('dt_heading_pr_num'); ?></th>
                            <th><?php echo lang('dt_heading_request_type'); ?></th>
                            <th><?php echo lang('dt_heading_item_name'); ?></th>
                            <th><?php echo lang('dt_heading_quantity'); ?></th>
                            <th><?php echo lang('dt_heading_price'); ?></th>
                            <th><?php echo lang('dt_heading_totalprice'); ?></th>
                            <th><?php echo lang('supplier_label'); ?></th>
                            <th><?php echo lang('initiator_label'); ?></th>
                            <th><?php echo lang('dt_heading_branch'); ?></th>
                            <th><?php echo lang('dt_heading_department'); ?></th>
                            <th><?php echo lang('label_year'); ?></th>
                            <th><?php echo lang('label_month_date'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                
            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
    xwb_var.varGetStaffItemReports = '<?php echo base_url('reports/getStaffItemReports'); ?>';

</script>
