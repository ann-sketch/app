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
 * Main controller for Department
 */
class Xwb_department extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('department/Department_model', 'Department');
    }
    

    /**
     * All department view
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        
        $data['page_title'] = lang('page_department_title'); //title of the page
        $data['page_script'] = 'department'; // script filename of the page department.js
        $this->renderPage('department/department', $data);
    }

    /**
     * Get all department to datatable
     *
     * @return json
     */
    public function getDept()
    {
        $d = $this->Department->getDept();
        
        $data['data'] = array();

        if ($d->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($d->result() as $key => $v) {
                $data['data'][] = array(
                                        $v->id,
                                        $v->name,
                                        $v->description,
                                        '<a href="" data-id="'.$v->id.'" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-dept">'.lang('btn_edit').'</a>
										<a href="" data-id="'.$v->id.'" class="'.$demo_disable.' btn btn-xs btn-danger xwb-del-dept">'.lang('btn_delete').'</a>',
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }


    /**
     * Get Department
     *
     * @return json
     */
    public function editDept()
    {
        $dept_id = $this->input->post('dept_id');
        $u = $this->db->get_where('department', array('id'=>$dept_id))->row();
        echo $this->xwbJsonEncode($u);
        exit();
    }


    /**
     * Update Department
     *
     * @return json
     */
    public function updateDept()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('lbl_name'), 'required|alpha_dash');
        $this->form_validation->set_rules('description', lang('lbl_description'), 'required');
        //$this->form_validation->set_rules('department_head', 'Department Head', 'required');
                
        
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    //'department_head' => $this->input->post('department_head'),
            );

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('department', $data);


            $data['status'] = true;
            $data['message'] = lang('msg_department_updated');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Add Department method
     *
     * @return json
     */
    public function addDept()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('lbl_name'), 'required|alpha_dash');
        $this->form_validation->set_rules('description', lang('lbl_description'), 'required');

        
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                            );
            $this->db->insert('department', $data);
            $data['status'] = true;
            $data['message'] = lang('msg_department_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Delete department
     *
     * @return array
     */
    public function deleteDept()
    {
        $rows = $this->Department->deleteDept();
        if ($rows > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_department_deleted');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }
}
