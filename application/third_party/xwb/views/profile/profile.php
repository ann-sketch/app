<!-- page content -->
<div class="row">
 <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php echo $page_title; ?> </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <?php
            if ($this->session->flashdata('errors') != null) :
            ?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            <?php echo $this->session->flashdata('errors'); ?>
            </div>
            <?php
            endif;
            ?>
            <?php
            if ($this->session->flashdata('success') != null) :
            ?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php
            endif;
            ?>
            <?php echo form_open_multipart('profile/updateProfile', array('class'=>'form-horizontal form-label-left input_mask')); ?>

                <code class="help"><?php echo lang('profile_pic_info'); ?></code>
                <hr />
                <p class="error"><?php echo lang('profile_pic_chmod'); ?></p>
                <hr />
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"><?php echo lang('lbl_upload_profilepic'); ?> :</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    
                        <div id='preview' class="center">
                        <img src="<?php echo base_url('profile/view_image?width=150&height=150&path='.$current_user->picture_path); ?>" alt="Profile Picture" class="img-responsive" id="profile-picture">
                        </div>
                        <input type="file" name="profile_pic" id="profile-pic" accept="image/*" />
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="first_name"><?php echo lang('lbl_fname'); ?>: </label>
                            <?php $first_name['class'] = 'form-control'; ?>
                            <?php echo form_input($first_name);?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="last_name"><?php echo lang('lbl_lname'); ?>: </label>
                            <?php $last_name['class'] = 'form-control'; ?>
                            <?php echo form_input($last_name);?>
                        </div>
                    </div>
                    
                         <?php
                            if($identity_column!=='email') {
                                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                                echo '<div class="form-group">';
                                echo '<label for="nick_name">'.lang('lbl_username').': </label>';
                                $identity['class'] = 'form-control';
                                echo form_input($identity);
                                echo '<br />';
                                echo form_error('identity');
                                echo '</div>';
                                echo '</div>';
                            }
                          ?>
                        
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="email"><?php echo lang('lbl_email'); ?>: </label>
                            <?php $email['class'] = 'form-control'; ?>
                            <?php echo form_input($email);?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="phone_number"><?php echo lang('lbl_phone'); ?>: </label>
                            <?php $phone_number['class'] = 'form-control'; ?>
                            <?php echo form_input($phone_number);?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="password"><?php echo lang('lbl_changepass'); ?>: </label>
                            <div class="input-group">
                                <?php 
                                $password['class'] = 'form-control';
                                $password['placeholder'] = lang('lbl_your_curr_pass');
                                ?>
                                <?php echo form_input($password);?>
                                <span class="input-group-btn">
                                    <button class="btn btn-info xwb-change-pass" type="button"><?php echo lang('btn_change'); ?></button>
                                </span>
                            </div><!-- /input-group -->

                        </div>
                    </div>
                </div>

                </div>


             
              <div class="form-group">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-success" <?php echo $demo_disable; ?>><?php echo lang('btn_submit'); ?></button>
                </div>
              </div>

            </form>
          </div>
        </div>


      </div>
</div>

<!-- /page content -->
<script type="text/javascript">
    xwb_var.varCheckPass = '<?php echo base_url("profile/checkPass"); ?>';
    xwb_var.varChangePass = '<?php echo base_url("user/changePass"); ?>';
    
</script>