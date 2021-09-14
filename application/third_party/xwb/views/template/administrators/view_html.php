<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $this->config->item('site_title'); ?> | <?php echo $page_title?$page_title:''; ?></title>
    
    <!-- favicon -->
    <link rel="icon" href="<?php echo base_url($this->config->item('fav_icon_filename')); ?>" type="image/png" sizes="16x16">

    <!-- Bootstrap -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css'); ?>" rel="stylesheet"/>

    <!-- DataTable stylesheet -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/media/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">

    <!-- Select2 Stylesheet -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendor/select2/select2/dist/css/select2.min.css'); ?>" rel="stylesheet">

    <!-- Noty Stylesheet -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendor/needim/noty/lib/noty.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'build/css/custom.min.css'); ?>" rel="stylesheet">

    <!-- XWB Purchasing Style -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'css/style.css'); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/jquery/dist/jquery.min.js'); ?>"></script>

    <!-- jQuery UI -->
    <link href="<?php echo base_url($this->config->item('assets_folder').'vendor/components/jqueryui/themes/base/jquery-ui.min.css'); ?>" rel="stylesheet">

    <!-- jQuery UI -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendor/components/jqueryui/jquery-ui.min.js'); ?>"></script>

    <script type="text/javascript">
        var xwb_var = {};
        xwb_var.group_name = '<?php echo $current_user->group_name; ?>';
        xwb_var.language = '<?php echo $language; ?>';
        
        xwb_var.langString = <?php echo json_encode($langString, JSON_HEX_APOS); ?>;
    </script>
  </head>

  <body class="nav-md">
    <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" class="xwb-csrf" />

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
            <?php
              echo $leftpane;
            ?>

            <!-- top navigation -->
            <?php
            echo $topnav;
            ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <?php if(!$upload_is_writable): ?>
                        <div class="row">
                            <p class="alert alert-warning"><?php echo lang('upload_folder_instruction'); ?> <br /><strong><?php echo lang('text_example'); ?></strong>:<code><?php echo lang('upload_folder_command'); ?></code></p>
                            <hr />
                        </div>
                    <?php endif; ?>

                    <?php if(!$mpdf_is_writable): ?>
                        <div class="row">
                            <p class="alert alert-warning"><?php echo lang('mpdf_writable_instruction'); ?> <br /><strong><?php echo lang('text_example'); ?></strong>:<code><?php echo lang('mpdf_writable_command'); ?></code></p>
                            <hr />
                        </div>
                    <?php endif; ?>
                    <?php
                    echo $body;
                    ?>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <?php
            echo $footer;
            ?>
            <!-- /footer content -->
            </div>
        
    </div>


    <!-- Bootstrap -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/fastclick/lib/fastclick.js'); ?>"></script>
    
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/media/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/extensions/Buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/extensions/Buttons/js/buttons.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/extensions/Buttons/js/buttons.flash.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/extensions/Buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/DataTables-1.10.16/extensions/Buttons/js/buttons.print.min.js'); ?>"></script>

    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/jszip/dist/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>

    <!-- Bootbox -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'js/bootbox.min.js'); ?>"></script>

    <!-- Noty -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendor/needim/noty/lib/noty.js'); ?>"></script>
    <!-- Populate -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'js/jquery.populate.js'); ?>"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'vendor/select2/select2/dist/js/select2.full.min.js'); ?>"></script>

    <!-- Custom Theme Scripts -->
    <!-- <script src="<?php echo base_url($this->config->item('assets_folder').'build/js/custom.min.js'); ?>"></script> -->
    <script src="<?php echo base_url($this->config->item('assets_folder').'build/js/custom.js'); ?>"></script>

    <script src="<?php echo base_url($this->config->item('assets_folder').'js/xwb.scripts.js'); ?>"></script>
    <?php if (isset($page_script)) : ?>
    <?php
    $file = file_exists(FCPATH.'assets/custom_scripts/'.$page_script.'.js');
        if($file):
        ?>
        <script src="<?php echo base_url($this->config->item('assets_folder').'custom_scripts/'.$page_script.'.js'); ?>"></script>
        <?php else: ?>
        <script src="<?php echo base_url($this->config->item('assets_folder').'pagescript/'.$page_script.'.js'); ?>"></script>
        <?php endif; ?>
    <?php endif; ?>
  </body>
</html>
