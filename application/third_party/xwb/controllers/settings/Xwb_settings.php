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
 * Main controller for settings
 */
class Xwb_settings extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings/Settings_model', 'Settings');
    }
    


    /**
     * View General Settings
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        $this->load->helper('form');
        $groups = $this->db->get('groups');
        $data['page_title'] = lang('settings_page_title'); //title of the page
        $data['page_script'] = 'settings'; // script filename of the page
        $this->renderPage('settings/settings', $data);
    }


    /**
     * View Console Settings
     *
     * @return mixed
     */
    public function console()
    {
        $this->redirectUser(array('admin','board'));
        $groups = $this->db->get('groups');
        $data['groups'] = $groups->result();
        $data['purchasing_version'] = getConfig('purchasing_version');
        $data['btnTextUpdate'] = lang('btn_update_database');
        
        $data['page_title'] = lang('console_page_title'); //title of the page
        $data['page_script'] = 'console'; // script filename of the page
        $this->renderPage('settings/console', $data);
    }

/**
     * View Email Messages Settings
     *
     * @return mixed
     */
    public function emails()
    {
        $this->redirectUser(array('admin','board'));
        $data['process'] = $this->config->item('email_names');
        
        $data['page_title'] = lang('emails_page_title'); //title of the page
        $data['page_script'] = 'emails'; // script filename of the page
        $this->renderPage('settings/emails', $data);
    }


    /**
     * Update general settings
     *
     * @return json
     */
    public function updateSettings()
    {
        $this->redirectUser(array('admin','board'));
        $posts = $this->input->post();
        foreach ($posts as $key => $value) {
            $res = $this->Settings->updateSettings($key, $value);
        }
        
        
        $data['status'] = true;
        $data['message'] = lang('msg_settings_updated');
        

        echo $this->xwbJsonEncode($data);
    }


    /**
     * Save company logo
     *
     * @return json
     */
    public function saveSettings()
    {
        $this->redirectUser(array('admin','board'));
        $config['upload_path']          = 'assets/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 500;
        $config['max_height']           = 300;

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload('logo')) {
            $error = array('error' => $this->upload->display_errors());
            $data['status'] = false;
            $data['message'] = $error['error'];
        } else {
            $data = array('upload_data' => $this->upload->data());
            
            $this->Settings->updateSettings('logo', $data['upload_data']['full_path']);
            $data['status'] = true;
            $data['message'] = lang('msg_logo_updated');
            $data['src'] = base_url('assets/images/'.$data['upload_data']['file_name']);
        }
        
        echo $this->xwbJsonEncode($data);
    }


    /**
     * Get Email Message
     *
     * @return json
     */
    public function getEmail()
    {
        $this->redirectUser(array('admin','board'));
        $process_key = $this->input->post('process_key');
        $emails = $this->db->get_where('emails', array('process_key'=>$process_key));
        if ($emails->num_rows()>0) {
            $emails = $emails->row();
            $data['subject'] = $emails->subject;
            $data['message'] = $emails->message;
        } else {
            $data['subject'] = "";
            $data['message'] = "";
        }
        
        echo $this->xwbJsonEncode($data);
    }

    public function updateEmail()
    {
        $this->redirectUser(array('admin','board'));
        $this->load->library('form_validation');
        $post = $this->input->post();
        $e = $this->db->get_where('emails', array('process_key'=>$post['process_key']));

        $this->form_validation->set_rules('process_key', lang('label_process_key'), 'required|alpha_dash');
        $this->form_validation->set_rules('subject', lang('modal_lbl_subject'), 'required');
        $this->form_validation->set_rules('email_message', lang('label_email_msg'), 'required');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            if ($e->num_rows()>0) {
                $this->db->where('process_key', $post['process_key']);
                $res = $this->db->update('emails', array(
                        'subject' => $post['subject'],
                        'message' => $post['email_message'],
                    ));
                $data['status'] = true;
                $data['message'] = lang('msg_email_updated');
            } else {
                $res = $this->db->insert('emails', array(
                        'process_key' => $post['process_key'],
                        'subject' => $post['subject'],
                        'message' => $post['email_message'],
                    ));

                
                if ($res) {
                    $data['status'] = true;
                    $data['message'] = lang('msg_email_updated');
                } else {
                    $data['status'] = false;
                    $data['message'] = lang('msg_error_update_data');
                }
            }
        }
        echo $this->xwbJsonEncode($data);
    }


    /**
     * Set the starting number of auto increment of the request number
     *
     * @return json
     */
    public function startPRIncrement()
    {
        $this->load->library('form_validation');
        $this->redirectUser(array('admin','board'));

        $this->form_validation->set_rules('pr', lang('pr_num_label'), 'required|is_natural');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $pr=$this->input->post('pr');
            $res = $this->db->query("ALTER TABLE request_list AUTO_INCREMENT=".$pr);
            if ($res) {
                $data['status'] = true;
                $data['message'] = lang('msg_req_num_updated');
            } else {
                $data['status'] = false;
                $data['message'] = lang('msg_error_update_data');
            }
        }
        echo $this->xwbJsonEncode($data);
    }



    /**
     * Set the starting number of purchase order auto increment
     *
     * @return json
     */
    public function startPOIncrement()
    {
        $this->load->library('form_validation');
        $this->redirectUser(array('admin','board'));

        $this->form_validation->set_rules('po', lang('po_num_label'), 'required|is_natural');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $po = $this->input->post('po');
            $res = $this->db->query("ALTER TABLE purchase_order AUTO_INCREMENT=".$po);
            if ($res) {
                $data['status'] = true;
                $data['message'] = lang('msg_success_update_po');
            } else {
                $data['status'] = false;
                $data['message'] = lang('msg_error_update_data');
            }
        }
        echo $this->xwbJsonEncode($data);
    }

    /**
     * Settings for all the record status
     *
     * @return json
     */
    public function status()
    {
        $this->redirectUser(array('admin','board'));
        $data['status_names'] = $this->status_names;
        $data['status_types'] = $this->status_types;
        $data['page_title'] = lang('page_status_title'); //title of the page
        $data['page_script'] = 'status'; // script filename of the page
        $this->renderPage('settings/status', $data);
    }

    /**
     * Get all the status on the system
     *
     * @return [json]
     */
    public function getStatus()
    {
        $this->redirectUser(array('admin','board'));

        $s = $this->Settings->getStatus();
        $data['data'] = array();

        if ($s->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($s->result() as $key => $v) {
                $data['data'][] = array(
                                        $v->status_name,
                                        $v->status_number,
                                        $v->status_text,
                                        '<label class="label label-'.$v->status_type.'">'.$v->status_type.'</label>',
                                        '<a href="" data-id="'.$v->id.'" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-status">'.lang('btn_edit').'</a>
                                        <a href="" data-id="'.$v->id.'" class="'.$demo_disable.' btn btn-xs btn-danger xwb-del-status">'.lang('btn_delete').'</a>',
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }


    /**
     * Add new status
     */
    public function addStatus()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('status_name', lang('dt_status_name'), 'required|alpha_dash');
        $this->form_validation->set_rules('status_number', lang('dt_status_num'), 'required|is_natural|callback_uniquestatus');
        $this->form_validation->set_rules('status_text', lang('dt_status_txt'), 'required');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                    'status_name' => $this->input->post('status_name'),
                    'status_number' => $this->input->post('status_number'),
                    'status_text' => $this->input->post('status_text'),
                    'status_type' => $this->input->post('status_type'),
            );

            $this->db->insert('status', $data);


            $data['status'] = true;
            $data['message'] = lang('msg_status_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }

    /**
     * Get status data to edit
     *
     * @return json
     */
    public function editStatus()
    {
        $status_id = $this->input->post('status_id');
        $s = $this->db->get_where('status', array('id'=>$status_id))->row();
        echo $this->xwbJsonEncode((array)$s);
        exit();
    }

    public function updateStatus()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', lang('lbl_status_id'), 'required');
        $this->form_validation->set_rules('status_name', lang('dt_status_name'), 'required|alpha_dash');
        $this->form_validation->set_rules('status_number', lang('dt_status_num'), 'required|is_natural|callback_uniquestatus');
        $this->form_validation->set_rules('status_text', lang('dt_status_txt'), 'required');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                    'status_name' => $this->input->post('status_name'),
                    'status_number' => $this->input->post('status_number'),
                    'status_text' => $this->input->post('status_text'),
                    'status_type' => $this->input->post('status_type'),
            );

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('status', $data);

            $data['status'] = true;
            $data['message'] = lang('msg_status_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Status number should be unique per status name
     *
     * @param  integer $value [Status number]
     * @return boolean
     */
    public function uniquestatus($value = 0)
    {
        $status_name = $this->input->post('status_name');
        $status_id = $this->input->post('id');
        $except = $status_id;

        $result = $this->Settings->checkStatusDuplicateNumber($status_name, $value, $except);
        if ($result !== 0) {
                $this->form_validation->set_message('uniquestatus', sprintf(lang('msg_uniquestatus'),'{field}') );
                return false;
        } else {
                return true;
        }
    }


    /**
     * Delete status
     * 
     * @return [json] [Result]
     */
    public function deleteStatus()
    {
        $rows = $this->Settings->deleteStatus();
        if ($rows > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_status_delete');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }

    /**
     * Update the database to the latest version
     * 
     * @return [type] [description]
     */
    public function updateDatabase(){
        if(getConfig('purchasing_version') != $this->purchasing_version){
            $this->Settings->updateSettings('purchasing_version', $this->purchasing_version);

            // Get query string on each table
            $this->db->query("ALTER DATABASE {$this->db->database} CHARACTER SET utf8 COLLATE utf8_general_ci;");
            $query = $this->db->query("SELECT CONCAT(\"ALTER TABLE \", TABLE_SCHEMA, '.', TABLE_NAME,' COLLATE utf8_general_ci;') AS mysql FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='{$this->db->database}' AND TABLE_TYPE = 'BASE TABLE';");

            // Execute queries
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                    $this->db->query($value->mysql);
                }
            }

           
            $query = $this->db->query('ALTER TABLE `purchase_order` CHANGE `po_num` `po_num` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');
        }

        $data['status'] = true;
        $data['message'] = lang('msg_db_updated');
        echo $this->xwbJsonEncode($data);
        exit();
    }
}
