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
 * Main controller for Supplier
 */
class Xwb_supplier extends XWB_purchasing_base
{

    
    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('supplier/Supplier_model', 'Supplier');
    }


    /**
     * Supplier view
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        $data['page_title'] = lang('page_supplier_title'); //title of the page
        $data['page_script'] = 'supplier'; // script filename of the page
        $this->renderPage('supplier/supplier', $data);
    }


    /**
     * Get supplier data for datatable
     *
     * @return json
     */
    public function getSupplier()
    {
        $this->redirectUser(array('admin','board'));
        $s = $this->Supplier->getSuppliers();

        $data['data'] = array();

        if ($s->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($s->result() as $k => $v) {
                $data['data'][] = array(
                                        $v->id,
                                        $v->supplier_name,
                                        $v->email,
                                        $v->tel_number,
                                        $v->phone_number,
                                        $v->fax,
                                        getPaymentTerm($v->payment_terms),
                                        $v->address,
                                        '<a href="" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-supplier" data-supplier="'.$v->id.'">'.lang('btn_edit').'</a>
										<a href="" class="'.$demo_disable.' btn btn-xs btn-danger xwb-del-supplier" data-supplier="'.$v->id.'">'.lang('btn_delete').'</a>'
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }


    /**
     * Add supplier method
     *
     * @return json
     */
    public function addSupplier()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('supplier_name', lang('lbl_supplier_name'), 'required');
        $this->form_validation->set_rules('tel_number', lang('dt_tel_num'), 'required');
        $this->form_validation->set_rules('phone_number', lang('dt_mobile_num'), 'required');
        $this->form_validation->set_rules('address', lang('dt_address'), 'required');
        $this->form_validation->set_rules('fax', lang('dt_fax'), 'required');
        $this->form_validation->set_rules('payment_terms', lang('payment_terms_label'), 'required');
        $this->form_validation->set_rules('email', lang('lbl_email'), 'required|valid_email|is_unique[supplier.email]');
        $this->form_validation->set_rules('address', lang('dt_address'), 'required');

        

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $posts = $this->input->post();
            $db_data = array(
                        'supplier_name' => $posts['supplier_name'],
                        'tel_number' => $posts['tel_number'],
                        'phone_number' => $posts['phone_number'],
                        'address' => $posts['address'],
                        'email' => $posts['email'],
                        'fax' => $posts['fax'],
                        'payment_terms' => $posts['payment_terms'],
                    );
            $this->db->insert('supplier', $db_data);
            $data['status'] = true;
            $data['message'] = lang('msg_supplier_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Get supplier data for edit
     *
     * @return json
     */
    public function editSupplier()
    {
        $supplier_id = $this->input->post('supplier_id');
        $s = $this->db->get_where('supplier', array('id'=>$supplier_id))->row();
        echo $this->xwbJsonEncode($s);
        exit();
    }



    /**
     * Update Supplier
     *
     * @return json
     */
    public function updateSupplier()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('supplier_name', lang('lbl_supplier_name'), 'required');
        $this->form_validation->set_rules('tel_number', lang('dt_tel_num'), 'required');
        $this->form_validation->set_rules('phone_number', lang('dt_mobile_num'), 'required');
        $this->form_validation->set_rules('address', lang('dt_address'), 'required');
                
        $this->form_validation->set_rules('fax', lang('dt_fax'), 'required');
        $this->form_validation->set_rules('payment_terms', lang('payment_terms_label'), 'required');

        $supplier_id = $this->input->post('id');


        $supp_unique = "";
        if ($supplier_id != "") {
            $s = $this->Supplier->getSupplier($supplier_id)->row();
            if ($s->email != $this->input->post('email')) {
                $supp_unique = "|is_unique[supplier.email]";
            }
        }


        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email'.$supp_unique);


        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $posts = $this->input->post();
            $db_data = array(
                        'supplier_name' => $posts['supplier_name'],
                        'tel_number' => $posts['tel_number'],
                        'phone_number' => $posts['phone_number'],
                        'address' => $posts['address'],
                        'email' => $posts['email'],
                        'fax' => $posts['fax'],
                        'payment_terms' => $posts['payment_terms'],
                    );

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('supplier', $db_data);


            $data['status'] = true;
            $data['message'] = lang('msg_supplier_updated');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }



    /**
     * Delete Supplier
     *
     * @return array
     */
    public function deleteSupplier()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('supplier');
        $res = $this->db->affected_rows();

        if ($res > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_supplier_deleted');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }
}
