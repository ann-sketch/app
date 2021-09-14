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
 * Main controller for Request Category
 */
class Xwb_request_category extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('request_category/Request_category_model', 'ReqCat');
    }
    

    /**
     * All request category view
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        $data['page_title'] = lang('page_reqcat_title'); //title of the page
        $data['page_script'] = 'request_category'; // script filename of the page
        $this->renderPage('request_category/request_category', $data);
    }



    /**
     * Get all request category to datatable
     *
     * @return json
     */
    public function getReqCat()
    {
        $r = $this->ReqCat->getReqCat();
        
        $data['data'] = array();

        if ($r->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($r->result() as $key => $v) {
                $data['data'][] = array(
                                        $v->id,
                                        $v->name,
                                        $v->description,
                                        '<a href="" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-request-cat" data-request_cat="'.$v->id.'">'.lang('btn_edit').'</a>
										<a href="" class="'.$demo_disable.' btn btn-xs btn-danger xwb-del-request-cat" data-request_cat="'.$v->id.'">'.lang('btn_delete').'</a>',
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }


    /**
     * Add Request Category method
     *
     * @return json
     */
    public function addReqCat()
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
            $this->db->insert('request_category', $data);
            $data['status'] = true;
            $data['message'] = lang('msg_reqcat_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Get Request Category
     *
     * @return json
     */
    public function editReqCat()
    {
        $reqcat_id = $this->input->post('reqcat_id');
        $u = $this->db->get_where('request_category', array('id'=>$reqcat_id))->row();
        echo $this->xwbJsonEncode($u);
        exit();
    }


    /**
     * Update Request Category
     *
     * @return json
     */
    public function updateReqCat()
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

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('request_category', $data);


            $data['status'] = true;
            $data['message'] = lang('msg_reqcat_updated');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Delete request category
     *
     * @return array
     */
    public function deleteReqCat()
    {
        $rows = $this->ReqCat->deleteReqCat();
        if ($rows > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_reqcat_deleted');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }
}
