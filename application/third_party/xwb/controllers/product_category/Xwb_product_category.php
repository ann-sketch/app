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
class Xwb_product_category extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_category/Product_category_model', 'Prodcat');
    }
    

    /**
     * Product Category view
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        $data['parent_cat'] = $this->Prodcat->getParentCat()->result();

        $data['page_title'] = lang('page_productcat_title'); //title of the page
        $data['page_script'] = 'product_cat'; // script filename of the page user.js
        $this->renderPage('product_category/product_cat', $data);
    }


    /**
     * Get product categories
     *
     * @return json
     */
    public function getProdCat()
    {
        $pc = $this->Prodcat->getProdCat();
        
        $data['data'] = array();

        if ($pc->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($pc->result() as $key => $v) {
                if (is_null($this->Prodcat->getCategory($v->parent)->row())) {
                    $parent = "--";
                } else {
                    $parent = $this->Prodcat->getCategory($v->parent)->row()->description;
                }
                $data['data'][] = array(
                                        $v->id,
                                        $v->name,
                                        $v->description,
                                        $parent,
                                        '<a href="" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-prodcat" data-prodcat="'.$v->id.'">'.lang('btn_edit').'</a>
										<a href="" class="'.$demo_disable.' btn btn-xs btn-danger xwb-del-prodcat" data-prodcat="'.$v->id.'">'.lang('btn_delete').'</a>
										',
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }



    /**
     * Add product category
     *
     * @return json
     */
    public function addProdCat()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('lbl_name'), 'required|alpha_dash');
        $this->form_validation->set_rules('description', lang('lbl_description'), 'required');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $parent = $this->input->post('parentcat');

            $data = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'parent' => $parent,
                            );
            $this->db->insert('product_categories', $data);
            $data['status'] = true;
            $data['message'] = lang('msg_productcat_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Delete product category
     *
     * @return json
     */
    public function deleteProdCat()
    {
        $cat_id = $this->input->post('cat_id');
        $rows = $this->Prodcat->deleteProdCat($cat_id);
        if ($rows > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_productcat_deleted');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Edit product category
     *
     * @return json
     */
    public function editProdCat()
    {
        $cat_id = $this->input->post('cat_id');
        $res = $this->Prodcat->getCategory($cat_id)->row();
        echo $this->xwbJsonEncode($res);
        exit();
    }



    /**
     * Update Category
     *
     * @return json
     */
    public function updateProdCat()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('lbl_name'), 'required|alpha_dash');
        $this->form_validation->set_rules('description', lang('lbl_description'), 'required');

        if ($this->input->post('id') == $this->input->post('parent')) {
            $data['status'] = false;
            $data['message'] = 'Select different parent';
            echo $this->xwbJsonEncode($data);
            exit();
        }

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $data = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'parent' => $this->input->post('parent'),
            );

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('product_categories', $data);


            $data['status'] = true;
            $data['message'] = lang('msg_productcat_updated');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }
}
