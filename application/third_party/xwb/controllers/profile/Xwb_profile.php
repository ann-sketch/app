<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * XWB Purchasing
 *
 * @package     XWB Purchasing
 * @author      Jay-r Simpron
 * @copyright   Copyright (c) 2017, Jay-r Simpron
 */


/**
 * Main controller for profile
 */
class Xwb_profile extends XWB_purchasing_base
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user/User_model', 'User');
        $this->load->model('user/ion_auth_model', 'Auth');
        $this->lang->load('auth');
    }

    /**
     * View Profile
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser();
        $identity_column = $this->config->item('identity', 'ion_auth');
        
        $user = $this->User->getUser($this->log_user_data->user_id)->row(); // get current user

        $data['user'] = $user;

        $data['identity_column'] = $identity_column;
        
        $data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $user->first_name,
        );
        $data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $user->last_name,
        );
        $data['identity'] = array(
            'name' => 'identity',
            'id' => 'identity',
            'type' => 'text',
            'value' => $user->{$identity_column},
        );
        $data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $user->email,
        );

        $data['phone_number'] = array(
            'name' => 'phone_number',
            'id' => 'phone_number',
            'type' => 'text',
            'value' => $user->phone_number,
        );
        $data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'value' => '',
        );
        $data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'value' => '',
        );


        $data['page_title'] = lang('page_profile_title');
        $data['page_script'] = 'profile'; // script filename of the page profile.js
        $this->renderPage('profile/profile', $data);
    }

    /**
     * Use to view profile image
     *
     * @return [type] [description]
     */
    public function view_image()
    {
        return $this->xwb_purchasing->view_image();
    }


    /**
     * Update profile
     *
     * @return void
     */
    public function updateProfile()
    {
        $this->redirectUser();
        $user = $this->User->getUser($this->log_user_data->user_id)->row(); // get current user

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $data['identity_column'] = $identity_column;
        $email_unique = '';
        if ($user->email != $this->input->post('email')) {
            
            $email_unique = "|is_unique[" . $tables['users'] . ".".$identity_column."]";
        }

        $this->form_validation->set_rules('first_name', lang('lbl_fname'), 'required');
        $this->form_validation->set_rules('last_name', lang('lbl_lname'), 'required');

        if ($identity_column !== 'email')
        {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required'.$email_unique);
            $this->form_validation->set_rules('email', lang('lbl_email'), 'trim|required|valid_email'.$email_unique); 
        }
        else
        {
            $this->form_validation->set_rules('email', lang('lbl_email'), 'trim|required|valid_email'.$email_unique);
        }

        $this->form_validation->set_rules('phone_number', lang('lbl_phone'), 'required');
        $upload_path = $this->config->item('storage_path').'images/profile_images/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            $this->session->set_flashdata('errors', validation_errors());
            redirect('profile');
        } else {
            $posts = $this->input->post();
            $user_id = $this->user_id;
            $db_data = array();
            if ($_FILES['profile_pic']['size'] != 0) {
                $config['upload_path']          = $upload_path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1000;
                $config['max_height']           = 1000;

                $this->load->library('upload', $config);

                if (! $this->upload->do_upload('profile_pic')) {
                    $error = array('error' => $this->upload->display_errors());
                    $data['status'] = false;
                    $data['message'] = $error['error'];
                    $this->session->set_flashdata('errors', $this->upload->display_errors());
                    redirect('profile');
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $db_data['picture_path'] = $data['upload_data']['full_path'];
                    $db_data['picture_mime'] = $data['upload_data']['file_type'];
                }
            }

            
            $db_data['first_name'] = $posts['first_name'];
            $db_data['last_name'] = $posts['last_name'];
            $db_data['nick_name'] = isset($posts['nick_name'])?$posts['nick_name']:'';
            $db_data['phone_number'] = $posts['phone_number'];


            $this->db->where('id', $user_id);
            $this->db->update('users', array(
                'username' => $posts['email'],
                'email' => $posts['email'],
            ));

            $this->db->where('user_id', $user_id);
            $res = $this->db->get('users_profile');
            if ($res->num_rows()==1) {
                $this->db->where('user_id', $user_id);
                $this->db->update('users_profile', $db_data);
            } else {
                $db_data['user_id'] = $user_id;
                $this->db->insert('users_profile', $db_data);
            }

            $this->session->set_flashdata('success', lang('msg_profile_updated'));
            redirect('profile');
        }
    }

    /**
     * Check current password
     * 
     * @return [Json] [description]
     */
    public function checkPass(){
        $this->form_validation->set_rules('password', lang('lbl_currpass'), 'trim|required|callback_check_pass');
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $user_id = $this->log_user_data->user_id;
            $data['status'] = true;
            $data['old_password'] = $this->input->post('password');
            $data['user_id'] = $user_id;
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Check password match validation
     * 
     * @param  [String] $password [description]
     * @return [Boolean]           [description]
     */
    public function check_pass($password){
        $user_id = $this->log_user_data->user_id;
        $isMatch = $this->Auth->hash_password_db($user_id, $password);

        if($isMatch){
            return true;
        }else{
            $this->form_validation->set_message('check_pass', lang('msg_pass_not_match'));
            return false;
        }

    }
}
