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
 * Main controller for product
 */
class Xwb_product extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product/Product_model', 'Product');
    }


    /**
     * Product view
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('admin','board'));
        $this->load->model('product_category/Product_category_model', 'Prodcat');

        $data['categories'] = $this->Prodcat->getParentCat()->result();

        $data['page_title'] = lang('page_product_title'); //title of the page
        $data['page_script'] = 'products'; // script filename of the page user.js
        $this->renderPage('product/products', $data);
    }


    /**
     * Get product
     *
     * @return json
     */
    public function getProducts()
    {
        $p = $this->Product->getProducts();
        
        $data['data'] = array();

        if ($p->num_rows()>0) {
            $demo_disable = ($this->config->item('demo')?'disabled':'');
            foreach ($p->result() as $key => $v) {
                $data['data'][] = array(
                                        $v->id,
                                        $v->product_name,
                                        $v->cat_description,
                                        '<a href="" class="'.$demo_disable.' btn btn-xs btn-warning xwb-edit-product" data-product="'.$v->id.'">'.lang('btn_edit').'</a>
										<a href="" class="'.$demo_disable.' btn btn-xs btn-danger xwb-del-product" data-product="'.$v->id.'">'.lang('btn_delete').'</a>
										',
                                        );
            }
        }
        echo $this->xwbJsonEncode($data);
    }



    /**
     * Add Product
     *
     * @return json
     */
    public function addProduct()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', lang('lbl_name'), 'required');
        $this->form_validation->set_rules('description', lang('lbl_description'), 'required');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $posts = $this->input->post();


            $data_products = array(
                        'product_name' => $posts['product_name'],
                        'product_category' => $posts['category'],
                            );
            $this->db->insert('products', $data_products);
            $prod_id = $this->db->insert_id();

            $data_prod_info = array(
                        'product_id' => $prod_id,
                        'description' => $posts['description'],
                            );
            $this->db->insert('product_information', $data_prod_info);


            $data['status'] = true;
            $data['message'] = lang('msg_product_added');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Delete Product
     *
     * @return json
     */
    public function deleteProduct()
    {
        $product_id = $this->input->post('product_id');
        $rows = $this->Product->deleteProduct($product_id);
        if ($rows > 0) {
            $data['status'] = true;
            $data['message'] = lang('msg_product_deleted');
        } else {
            $data['status'] = false;
            $data['message'] = lang('msg_error_req_deleted');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }


    /**
     * Edit product
     *
     * @return json
     */
    public function editProduct()
    {
        $product_id = $this->input->post('product_id');
        $res = $this->Product->getProduct($product_id)->row();
        echo $this->xwbJsonEncode($res);
        exit();
    }



    /**
     * Update Product
     *
     * @return json
     */
    public function updateProduct()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', lang('lbl_name'), 'required');
        $this->form_validation->set_rules('prod_info', lang('lbl_description'), 'required');

        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $posts = $this->input->post();
            $data_products = array(
                        'product_name' => $posts['product_name'],
                        'product_category' => $posts['category'],
                    );
            $this->Product->updateProduct($posts['id'], $data_products);

            $data_prod_info = array(
                        'description' => $posts['prod_info'],
                            );
            $this->Product->updateProductInfo($posts['id'], $data_prod_info);
            

            $data['status'] = true;
            $data['message'] = lang('msg_product_updated');
        }

        echo $this->xwbJsonEncode($data);
        exit();
    }
}
