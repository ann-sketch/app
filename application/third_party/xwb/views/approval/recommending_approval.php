<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="loader"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
              <a href="javascript:history.go(-1);" class="btn btn-warning"><?php echo lang('btn_back'); ?></a><h3 class="panel-title"><?php echo $page_title; ?></h3>
              <em class="text-danger"><?php echo lang('recommending_title_info'); ?></em>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo lang('dt_heading_user'); ?></h3>
                            <em class="text-danger"><?php echo lang('recommending_user_panel_info'); ?></em>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('select_head_user'); ?></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="head_users" id="head_users" style="width: 100%;">
                                        <option><?php echo lang('select_user'); ?></option>

                                    <?php
                                    $user_id = $this->log_user_data->user_id;
                                    foreach ($head_users as $key => $value) :
                                        if ($user_id == $value->id) {
                                            $you = '(You)';
                                        } else {
                                            $you = '';
                                        }
                                    ?>
                                        <option value="<?php echo $value->id; ?>"> <?php echo $you." ".ucwords($value->first_name." ".$value->last_name." (".$value->description.")"); ?> </option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="javascript:;" class="btn btn-danger delete_approve_user disabled" onClick="xwb.deleteApprovingUser()" title="Delete as Approving Officer"><?php echo lang('btn_delete_as_approving'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo lang('dt_items'); ?></h3>
                            <em class="text-danger"><?php echo lang('recommending_item_panel_info'); ?></em>
                        </div>
                        <div class="panel-body">
                            <div class="checkbox">
                                <label>
                                  <input name="items[]" id="checkall" class="checkall" type="checkbox"> <strong><?php echo lang('check_all'); ?></strong>
                                </label>
                          </div>
                          <hr class="hr-inherit-margin" />
                            <?php foreach ($items as $key => $value) : ?>
                                <div class="checkbox">
                                    <label>
                                      <input name="items[]" id="items" class="item_<?php echo $value->id; ?> items" value="<?php echo $value->id; ?>" type="checkbox"> <?php echo $value->product_name; ?>
                                    </label>
                              </div>

                            <?php endforeach; ?>

                        </div>
                        <div class="panel-footer">
                            <a href="javascript:;" onClick="xwb.assignItems()" class="btn btn-success assign disabled" title="Tag to head user"><?php echo lang('btn_assign'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo lang('recommending_list_panel'); ?></h3>
                            <em class="text-danger"><?php echo lang('recommending_list_panel_info'); ?></em>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table_items_approval">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('dt_heading_item_name'); ?></th>
                                            <th><?php echo lang('dt_heading_quantity'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">

            </div>
        </div>

    </div>
</div>

<!-- Javascript variable from php for this page here -->
<script type="text/javascript">
xwb_var.varGetItemsForApproval = "<?php echo base_url('approval/getItemsForApproval'); ?>";
xwb_var.varGetApprovalItems = "<?php echo base_url('approval/getApprovalItems'); ?>";
xwb_var.varAssignItems = "<?php echo base_url('approval/assignItems'); ?>";
xwb_var.varDeleteApprovingUser = "<?php echo base_url('approval/deleteApprovingUser'); ?>";

xwb_var.requestID = <?php echo $request_id; ?>;
xwb_var.approvalID = <?php echo $approval_id; ?>;

</script>