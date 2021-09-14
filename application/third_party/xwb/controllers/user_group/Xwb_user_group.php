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
 * Main controller for User Group
 */
class Xwb_user_group extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_group/Usergroup_model', 'Usergroup');
    }


    
    /**
     * View user group
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        $data['page_title'] = lang('page_ugroup_title');
        $data['page_script'] = 'user_group';
        $this->renderPage('user_group/user_group', $data);
    }


    /**
     * Get all user groups
     *
     * @return json
     */
    public function getUGroup()
    {
        $d = $this->Usergroup->getUGroups();
        
        $data['data'] = array();

        if ($d->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($d->result() as $key => $v) {
                $data['data'][] = array(
                                        $v->id,
                                        $v->name,
                                        $v->description,
                                        '<a href="javascript:;" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-group" data-group="'.$v->id.'">'.lang('btn_edit').'</a>
										',
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }



    /**
     * Get user group to edit
     * @return json
     */
    public function editUGroup()
    {
        $dept_id = $this->input->post('group_id');
        $u = $this->Usergroup->getUGroup($dept_id)->row();
        echo $this->xwbJsonEncode($u);
        exit();
    }



    /**
     * Update user group
     *
     * @return json
     */
    public function updateUGroup()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('description', lang('lbl_description'), 'required');
        
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                    'description' => $this->input->post('description'),
            );

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('groups', $data);


            $data['status'] = true;
            $data['message'] = lang('msg_ugroup_updated');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }



    /**
     * Add User Group
     *
     * @return json
     */
    public function addUGroup()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_dash');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                    );
            $this->db->insert('groups', $data);
            $data['status'] = true;
            $data['message'] = lang('msg_ugroup_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }

    /**
     * Delete user group
     *
     * @return json
     */
    public function deleteUGroup()
    {
        $group_id = $this->input->post('group_id');
        $rows = $this->Usergroup->deleteGroup($group_id);
        if ($rows > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_ugroup_deleted');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }
}
