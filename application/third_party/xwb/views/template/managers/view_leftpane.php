<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo base_url(''); ?>" class="site_title">
        <?php if (getConfig('logo_to_use')=='logo') : ?>
            <div id="preview" class="center">
                <img src="<?php echo base_url('view_image?path='.getConfig('logo')); ?>" alt="<?php echo (getConfig('company_name')==''?lang('lbl_company_name'):getConfig('company_name')); ?>" class="img-responsive" id="company_logo">
            </div>
        <?php else : ?>
            <h3 class="compony_logo_name">
                <?php echo (getConfig('company_name')==''?lang('lbl_company_name'):getConfig('company_name')); ?>
            </h3>
        <?php endif; ?>
      </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php echo base_url('profile/view_image?width=58&height=58&path='.$current_user->picture_path); ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span><?php echo lang('lbl_welcome'); ?>,</span>
        <h2><?php echo $current_user->first_name; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3><?php echo lang('lbl_menu'); ?></h3>
        <ul class="nav side-menu">
                    <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-laptop"></i> <?php echo lang('dashboard_page_title'); ?> </a></li>

                    <li><a href="javascript:;"><i class="fa fa-list"></i> <?php echo lang('request_label'); ?> <span class="badge badge-success pull-right"><?php echo $notification->my_req_action; ?></span><span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if ($current_user->group_name!='property') : ?>
                                <li><a href="<?php echo base_url('request/reqlist'); ?>"><?php echo lang('request_list_page_title'); ?>
                                    <span class="badge badge-success pull-right"></span>
                                </a></li>
                            <?php endif; ?>
                            <?php if ($current_user->department_head == 1) : ?>
                                <li><a href="<?php echo base_url('request/staff_request'); ?>"><?php echo lang('staff_req_page_title'); ?> </a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo base_url('request'); ?>"><?php echo lang('menu_my_req'); ?> <span class="badge badge-success pull-right"><?php echo $notification->my_req_action; ?></span> </a></li>
                            <li><a href="<?php echo base_url('request/newreq'); ?>"><?php echo lang('menu_request_new'); ?> </a></li>
                        </ul>
                    </li>

                    <?php if ($current_user->department_head == 1) : ?>
                      <li><a href="<?php echo base_url('approval/for_approval'); ?>"><i class="fa fa-check-circle"></i> <?php echo lang('menu_head_approval'); ?> <span class="badge badge-success pull-right"><?php echo $notification->head_approval_action; ?></span> </a></li>
                      <li><a href="javascript:;"><i class="fa fa-bar-chart"></i> <?php echo lang('menu_staff_reports'); ?> <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('reports/staff_request'); ?>"><?php echo lang('reqreport_page_title'); ?> </a></li>
                              <li><a href="<?php echo base_url('reports/staff_items'); ?>"><?php echo lang('item_report_page_title'); ?> </a></li>
                              <li><a href="<?php echo base_url('reports/staff_po'); ?>"><?php echo lang('po_report_page_title'); ?></a></li>
                          </ul>
                      </li>
                    <?php endif; ?>
                    <?php if ($current_user->group_name=='property') : ?>
                      <li><a href="<?php echo base_url('property/request_done'); ?>"><i class="fa fa-check-circle"></i> <?php echo lang('page_property_reqdone_title'); ?> <span class="badge badge-success pull-right"><?php echo $notification->property_action; ?></span> </a></li>
                    <?php endif; ?>
                    <?php if ($current_user->group_name=='canvasser') : ?>
                      <li><a href="<?php echo base_url('canvasser/req_assign'); ?>"><i class="fa fa-database"></i> <?php echo lang('menu_req_assigned'); ?> <span class="badge badge-success pull-right"><?php echo $notification->canvass_action; ?></span></a></li>
                    <?php endif; ?>
                    <?php if ($current_user->group_name=='budget') : ?>
                      <li><a href="<?php echo base_url('budget/req_approval'); ?>"><i class="fa fa-database"></i> <?php echo lang('menu_budget_approval'); ?> <span class="badge badge-success pull-right"><?php echo $notification->budget_action; ?></span></a></li>
                    <?php endif; ?>
                    <?php if ($current_user->group_name=='auditor') : ?>
                      <li><a href="<?php echo base_url('auditor/audit_list'); ?>"><i class="fa fa-database"></i> <?php echo lang('menu_for_audit'); ?> <span class="badge badge-success pull-right"><?php echo $notification->auditor_action; ?></span></a></li>
                    <?php endif; ?>
                    <?php if ($current_user->group_name=='budget') : ?>
                      <li><a href="javascript:;"><i class="fa fa-bar-chart"></i> <?php echo lang('menu_reports'); ?> <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('reports/request'); ?>"><?php echo lang('reqreport_page_title'); ?> </a></li>
                              <li><a href="<?php echo base_url('reports/items'); ?>"><?php echo lang('menu_item_reports'); ?> </a></li>
                              <li><a href="<?php echo base_url('reports/po'); ?>"><?php echo lang('po_report_page_title'); ?></a></li>
                          </ul>
                      </li>
                    <?php endif; ?>
                </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings" href="<?php echo base_url('settings'); ?>">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Profile" href="<?php echo base_url('profile'); ?>">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Help" href="<?php echo base_url('help'); ?>">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('user/auth/logout'); ?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
    </div>
</div>
