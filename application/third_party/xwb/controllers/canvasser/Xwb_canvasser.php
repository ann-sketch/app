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
 * Main controller for Canvasser
 */
class Xwb_canvasser extends XWB_purchasing_base
{

    /**
     * Run parent construct
     *
     * @return Null
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('canvasser/Canvasser_model', 'Canvasser');
        $this->load->model('item/Item_model', 'Item');
    }
    

    /**
     * All users view
     *
     * @return mixed
     */
    public function index()
    {
        $this->redirectUser(array('canvasser'));
        

        $this->load->model('request/Request_model', 'Request');
        $this->load->model('admin/Admin_model', 'Admin');
        $user_id = $this->log_user_data->user_id;
        $request = $this->Request->getRequestListByUser($user_id)->result();
        $gauge_data = $this->Admin->generateGaugeData($request);
        $data['progress_label'] = $this->Admin->progressLabel();
        $data['gauge_data'] = $gauge_data;
        
        $groups = $this->db->get('groups');
        $data['groups'] = $groups->result();
        $data['page_title'] = 'Canvasser'; //title of the page
        $data['page_script'] = 'canvasser'; // script filename of the page user.js
        $this->renderPage('canvasser/canvasser', $data);
    }

    /**
     * All request view
     *
     * @return mixed
     */
    public function request()
    {
        $this->redirectUser(array('page'=>'canvasser'));
        
        $data['page_title'] = lang('page_canvass_myrequest_title'); //title of the page
        $data['page_script'] = 'request'; // script filename of the page user.js
        $this->renderPage('request', $data);
    }

    /**
     * New request
     *
     * @return mixed
     */
    public function new_request()
    {
        
        unset($_SESSION['new_request']);
        $data['page_title'] = lang('new_requests_tile'); //title of the page
        $data['page_script'] = 'new_request'; // script filename of the page user.js
        $this->renderPage('new_request', $data);
    }


    /**
     * View assigned request page
     *
     * @return mixed
     */
    public function req_assign()
    {
        $this->redirectUser(array('page'=>'canvasser'));
        
        $this->load->model('user/User_model', 'User');
        $data['budget_users'] = $this->User->getUsersByGroup('budget')->result();
        $data['admin_users'] = $this->User->getUsersByGroup('admin')->result();
        $data['page_title'] = lang('page_canvass_assigned_title'); //title of the page
        $data['page_script'] = 'assigned_req'; // script filename of the page user.js
        $this->renderPage('canvasser/assigned_req', $data);
    }


    /**
     * Get assigned request
     * @return type
     */
    public function getAssignedRequest()
    {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('request/Request_model', 'Request');
    

        $this->Canvasser->getCanvassAssignedRequest($user_id);

        $recordsTotal = $this->db->count_all_results();
        $args = array($user_id);
        $recordsFiltered = $this->Canvasser->countFiltered('getCanvassAssignedRequest', $args);
        

        $this->Canvasser->getCanvassAssignedRequest($user_id);
        if ($this->input->get('length') != -1) {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
        }
        $req_assign = $this->db->get();



        $data['data'] = array();
        

        if ($req_assign->num_rows()>0) {
            foreach ($req_assign->result() as $key => $v) {
                if ($v->status==3) {
                    $disable_update = "disabled";
                } else {
                    $disable_update = "";
                }
                
                $data['data'][] = array(
                                        sprintf('PR-%08d', $v->request_id),
                                        $v->request_name,
                                        date("F j, Y, g:i a", strtotime($v->date_created)),
                                        //priority_label($v->priority_level).priority_time($v->priority_level,$v->date_created),
                                        ($v->date_needed==null?"":date("F j, Y", strtotime($v->date_needed))),
                                        '<a href="javascript:;" onClick="xwb.viewItems('.$v->request_id.')" class="btn btn-app"><i class="fa fa-search"></i>'.lang('btn_view_items').'</a>',
                                        number_format($v->total_amount, 2, '.', ','),
                                        $this->canvassActionBtn($v->id, $v->status),
                                        $this->xwb_purchasing->getStatus('canvass', $v->status)." ".'<label class="badge badge-info">'.time_elapse($v->date_updated).'</label>',
                                        );
            }
        }
        $data['draw'] = $this->input->get('draw');
        $data['recordsTotal'] = $recordsTotal;
        $data['recordsFiltered'] = $recordsFiltered;
        echo $this->xwbJsonEncode($data);
    }



    /**
     * View items to update
     *
     * @param int $canvass_id
     * @return mixed
     */
    public function update_items($canvass_id)
    {
        $this->redirectUser(array('page'=>'canvasser'));

        $this->load->model('product/Product_model', 'Product');
        $this->load->model('request/Request_model', 'Request');
        $this->load->model('supplier/Supplier_model', 'Supplier');
        
        $groups = $this->db->get('groups');
        $data['groups'] = $groups->result();
        $data['canvass'] = $this->Canvasser->getCanvass($canvass_id)->row();
        
        $data['request_id'] = $data['canvass']->request_id;

        $data['unit_measurements'] = $this->config->item('unit_measurement');

        $data['products'] = $this->Product->getProducts()->result();
        $data['items'] = $this->Request->getItemsPerRequestCanvasser($data['canvass']->request_id)->result();

        /*Remove duplicate items*/
        $itemName = [];
        $items = [];
        foreach ($data['items'] as $key => $value) {
            if(!in_array($value->product_name, $itemName)){
                $itemName[] = $value->product_name;
                $items[] = $value;
            }
        }
        $data['items'] = $items;

        $data['suppliers'] = $this->Supplier->getSuppliers()->result();

        $data['page_title'] = lang('page_updateitem_title'); //title of the page
        $data['page_script'] = 'update_items'; // script filename of the page user.js
        $this->renderPage('canvasser/update_items', $data);
    }



    /**
     * update items post method
     *
     * @return json
     */
    public function updateItems()
    {
        $this->load->helper('security');
        $this->load->model('request/Request_model', 'Request');
        $this->load->model('supplier/Supplier_model', 'Supplier');
        $this->load->model('item/Item_model', 'Item');
        $this->load->model('canvassed/Canvassed_model', 'Canvassed');
        
        $this->form_validation->set_rules('init_canvass_date', lang('lbl_initial_canvass_date'), 'required');
        if ($this->input->post('include_supplier1[]')) {
            foreach ($this->input->post('include_supplier1[]') as $key => $value) {
                $this->form_validation->set_rules('supplier1['.$key.']', lang('dt_supplier1'), 'required');
                $this->form_validation->set_rules('unit_price1['.$key.']', lang('dt_heading_price'), 'required|greater_than[0]');
                $this->form_validation->set_rules('qty1['.$key.']', lang('dt_heading_quantity'), 'required|greater_than[0]');
                $this->form_validation->set_rules('total1['.$key.']', lang('dt_total_label'), 'required|greater_than[0]');
            }
        }

        if ($this->input->post('include_supplier2[]')) {
            foreach ($this->input->post('include_supplier2[]') as $key => $value) {
                $this->form_validation->set_rules('supplier2['.$key.']', lang('dt_supplier2'), 'required');
                $this->form_validation->set_rules('unit_price2['.$key.']', lang('dt_heading_price'), 'required|greater_than[0]');
                $this->form_validation->set_rules('qty2['.$key.']', lang('dt_heading_quantity'), 'required|greater_than[0]');
                $this->form_validation->set_rules('total2['.$key.']', lang('dt_total_label'), 'required|greater_than[0]');
            }
        }

        if ($this->input->post('include_supplier3[]')) {
            foreach ($this->input->post('include_supplier3[]') as $key => $value) {
                $this->form_validation->set_rules('supplier3['.$key.']', lang('dt_supplier3'), 'required');
                $this->form_validation->set_rules('unit_price3['.$key.']', lang('dt_heading_price'), 'required|greater_than[0]');
                $this->form_validation->set_rules('qty3['.$key.']', lang('dt_heading_quantity'), 'required|greater_than[0]');
                $this->form_validation->set_rules('total3['.$key.']', lang('dt_total_label'), 'required|greater_than[0]');
            }
        }

        if ($this->input->post('include_supplier4[]')) {
            foreach ($this->input->post('include_supplier4[]') as $key => $value) {
                $this->form_validation->set_rules('supplier4['.$key.']', lang('dt_supplier4'), 'required');
                $this->form_validation->set_rules('unit_price4['.$key.']', lang('dt_heading_price'), 'required|greater_than[0]');
                $this->form_validation->set_rules('qty4['.$key.']', lang('dt_heading_quantity'), 'required|greater_than[0]');
                $this->form_validation->set_rules('total4['.$key.']', lang('dt_total_label'), 'required|greater_than[0]');
            }
        }

        $this->form_validation->set_rules('net_total', lang('dt_heading_totalprice'), 'required|greater_than[0]');


        if ($this->form_validation->run($this) == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
        } else {
            $posts = $this->input->post();
            $request_id = $posts['request_id'];
            $canvass_id = $posts['canvass_id'];

            /* Save to canvassed items */

            $canvassed_new_supplier = [];
            $canvassed_update_supplier = [];
            $new_db_data = [];
            for ($i=1; $i <= 4; $i++) {
                foreach ($posts['supplier'.$i] as $key => $value) {
                    if (substr($key, 0, 3) === "new") {
                        $po_id = explode('_', $key);
                        $item_id = $po_id[1];
                        $cp_id = '';
                    } else {
                        $po_id = explode('_', $key);
                        $item_id = $po_id[0];
                        $cp_id = $po_id[1];
                    }

                    $item = $this->Item->getItem($item_id)->row();

                    /* New Canvassed Item */
                    if ($cp_id == "") {
                        if ($this->input->post('include_supplier'.$i.'[]') && array_key_exists($key, $posts['include_supplier'.$i])) {
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                        $canvassed_new_supplier = array(
                                'request_id' => $request_id,
                                'canvass_id' => $canvass_id,
                                'item_id' => $item_id,
                                'product_id' => $item->product_id,
                                'product_name' => $item->product_name,
                                'product_description' => $item->product_description,
                                'quantity' => (int)$posts['qty'.$i][$key],
                                'price' => (float)$posts['unit_price'.$i][$key],
                                'total_amount' => (float)$posts['total'.$i][$key],
                                'status' => $status,
                                'date_updated' => date('Y-m-d H:i:s'),
                            );


                        $supplier = $posts['supplier'.$i][$key];

                        if (ctype_digit($supplier)) {
                            $s = $this->Supplier->getSupplier($supplier)->row();
                            if (is_null($s)) {
                                $canvassed_new_supplier['supplier_id'] = 0;
                                $canvassed_new_supplier['supplier'] = $supplier;
                            } else {
                                $canvassed_new_supplier['supplier_id'] = $supplier;
                                $canvassed_new_supplier['supplier'] = $s->supplier_name;
                            }
                        } else {
                            $canvassed_new_supplier['supplier_id'] = 0;
                            $canvassed_new_supplier['supplier'] = $supplier;
                        }

                        $new_db_data[] = $canvassed_new_supplier;
                    } else {
                        // Update canvassed prices
                        if ($this->input->post('include_supplier'.$i.'[]') && array_key_exists($key, $posts['include_supplier'.$i])) {
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                        $canvassed_update_supplier = array(
                                'request_id' => $request_id,
                                'canvass_id' => $canvass_id,
                                'item_id' => $item_id,
                                'product_id' => $item->product_id,
                                'product_name' => $item->product_name,
                                'product_description' => $item->product_description,
                                'quantity' => (int)$posts['qty'.$i][$key],
                                'price' => (float)$posts['unit_price'.$i][$key],
                                'total_amount' => (float)$posts['total'.$i][$key],
                                'status' => $status,
                                'date_updated' => date('Y-m-d H:i:s'),
                            );

                        $supplier = $posts['supplier'.$i][$key];


                        if (ctype_digit($supplier)) {
                            $s = $this->Supplier->getSupplier($supplier)->row();
                            if (is_null($s)) {
                                $canvassed_update_supplier['supplier_id'] = 0;
                                $canvassed_update_supplier['supplier'] = $supplier;
                            } else {
                                $canvassed_update_supplier['supplier_id'] = $supplier;
                                $canvassed_update_supplier['supplier'] = $s->supplier_name;
                            }
                        } else {
                            $canvassed_update_supplier['supplier_id'] = 0;
                            $canvassed_update_supplier['supplier'] = $supplier;
                        }

                        $this->Canvassed->updateData($cp_id, $canvassed_update_supplier);
                    }
                }
            }


            if (count($new_db_data)>0) {
                $this->db->insert_batch('canvassed_prices', $new_db_data);
            }



            //get existing items
            $existing_items = $this->Request->getItemsPerRequest($request_id)->result();
            $existing_item_ids = array();
            foreach ($existing_items as $key => $existingVal) {
                $existing_item_ids[] = $existingVal->id;
            }

            //get included items
            $included_items = array();
            $included_item_keys = array();
            for ($i=1; $i <= 4; $i++) {
                if ($this->input->post('include_supplier'.$i.'[]')) {
                    foreach ($posts['include_supplier'.$i] as $key => $value) {
                        $included_item_keys[] = $key;

                        if (substr($key, 0, 3) === "new") {
                            $po_id = explode('_', $key);
                            $included_items[] = $po_id[1];
                        } else {
                            $po_id = explode('_', $key);
                            $included_items[] = $po_id[0];
                        }
                        
                        $included_supplier[$key] = $posts['supplier'.$i][$key];
                        $included_unit_price[$key] = $posts['unit_price'.$i][$key];
                        $included_quantity[$key] = $posts['qty'.$i][$key];
                    }
                }
            }


            // deleting existing items not checked
            foreach ($existing_item_ids as $key => $value) {
                if (!in_array($value, $included_items)) {
                    $this->db->delete('po_items', array('id' => $value));
                }
            }


            // Process insert update po_items
            $new_db_data = array();
            $update_db_data = array();
            $count_duplicate = array();
            foreach ($included_item_keys as $key => $value) {
                if (substr($value, 0, 3) === "new") {
                    $item = explode('_', $value);
                    $item_id = $item[1];
                } else {
                    $item = explode('_', $value);
                    $item_id = $item[0];
                }
                

                $count_duplicate[] = $item_id;
                
                if (in_array($item_id, $existing_item_ids) && array_count_values($count_duplicate)[$item_id] == 1) {
                    // Items to update
                    $arr_data = array(
                        'unit_measurement' => $posts['unit_measurements'][$item_id],
                        'unit_price' => (float)$included_unit_price[$value],
                        'quantity' => (int)$included_quantity[$value],
                        'date_updated' => date('Y-m-d H:i:s'),
                    );

                    if (ctype_digit($included_supplier[$value])) {
                        $s = $this->Supplier->getSupplier($included_supplier[$value])->row();
                            
                        if (is_null($s)) {
                            $arr_data['supplier_id'] = 0;
                            $arr_data['supplier'] = $included_supplier[$value];
                        } else {
                            $arr_data['supplier_id'] = $included_supplier[$value];
                            $arr_data['supplier'] = $s->supplier_name;
                        }
                    } else {
                        $arr_data['supplier_id'] = 0;
                        $arr_data['supplier'] = $included_supplier[$value];
                    }

                    $update_db_data = $arr_data;
                    $this->Request->updateItem($item_id, $update_db_data);
                } else {
                    // Item to insert

                    for ($i=1; $i <= 4; $i++) {
                        if (array_key_exists($value, $posts['supplier'.$i])) {
                            //$posts['supplier'.$i][$value]
                            $item = explode('_', $value);
                            if (substr($value, 0, 3) === "new") {
                                $item = explode('_', $value);
                                $item_id = $item[1];
                            } else {
                                $item = explode('_', $value);
                                $item_id = $item[0];
                            }
                            $item = $this->Item->getItem($item_id)->row();
                            $unit_price = $posts['unit_price'.$i][$value];
                            $quantity = $posts['qty'.$i][$value];
                            $supplier = $posts['supplier'.$i][$value];
                            $arr_data = array(
                                    'request_id' => $item->request_id,
                                    'product_id' => $item->product_id,
                                    'product_name' => $item->product_name,
                                    'product_description' => $item->product_description,
                                    'unit_price' => (float)$unit_price,
                                    'quantity' => (int)$quantity,
                                    'date_updated' => date('Y-m-d H:i:s'),
                                    );

                            if (ctype_digit($supplier)) {
                                $s = $this->Supplier->getSupplier($supplier)->row();
                                if (is_null($s)) {
                                    $arr_data['supplier_id'] = 0;
                                    $arr_data['supplier'] = $supplier;
                                } else {
                                    $arr_data['supplier_id'] = $supplier;
                                    $arr_data['supplier'] = $s->supplier_name;
                                }
                            } else {
                                $arr_data['supplier_id'] = 0;
                                $arr_data['supplier'] = $supplier;
                            }
                            $new_db_data[] = $arr_data;
                        }
                    }
                }
            }

            // Insert new po items
            if (count($new_db_data)>0) {
                $this->db->insert_batch('po_items', $new_db_data);
            }


            $this->updateNetAmmount($posts['request_id'], $posts['canvass_id'], $posts['net_total']);


            $db_data = array(
                    'status'=>2,
                    'total_amount'=> (float)$posts['net_total'],
                    'date_updated' => date('Y-m-d H:i:s'),
                    'init_canvass_date' =>$this->input->post('init_canvass_date')
                    );


            $res = $this->updateCanvass($posts['canvass_id'], $db_data);

            

            $data['status'] = true;
            $data['message'] = lang('msg_items_updated');
        }
        echo $this->xwbJsonEncode($data);
    }



    
    /**
     * Update Net amount
     *
     * @param int $request_id
     * @param int $canvass_id
     * @param float $net_amount
     * @return void
     */
    public function updateNetAmmount($request_id, $canvass_id, $net_amount)
    {

        $this->db->where('id', $request_id);
        return $this->db->update('request_list', array('total_amount'=>$net_amount,'date_updated' => date('Y-m-d H:i:s')));
    }


    /**
     * Update Canvass
     *
     * @param int $id
     * @param type|array $db_data
     * @return boolean
     */
    public function updateCanvass($id, $db_data = array())
    {

        $this->db->where('id', $id);
        return $this->db->update('canvass', $db_data);
    }



    /**
     * Canvass Action Button generator
     *
     * @param int $canvass_id
     * @param int $status
     * @return string
     */
    public function canvassActionBtn($canvass_id, $status)
    {

        $this->redirectUser();
        $defaultbtn = '<li><a href="'.base_url('canvasser/update_items/'.$canvass_id).'">'.lang('btn_update_items').'</a></li>';
        $defaultbtn .= '<li><a target="_blank" href="'.base_url('canvasser/print_request/'.$canvass_id).'" >'.lang('btn_print_req').'</a></li>';
        $defaultbtn .= '<li><a href="javascript:;" onClick="xwb.supplierSummary('.$canvass_id.')" >'.lang('btn_supplier_summary').'</a></li>';
        //$defaultbtn .= '<li><a target="_blank" href="'.base_url('canvasser/print_canvassed/'.$canvass_id).'" >Print Canvassed</a></li>';
        
        switch ($status) {
            case 1:
                $btn = $defaultbtn;
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.toRequisitioner('.$canvass_id.')">'.lang('btn_return_initiator').'</a></li>';
                break;

            case 2:
                $btn = $defaultbtn;
                //$btn .= '<li><a href="javascript:;" onClick="xwb.assignToBudget('.$canvass_id.')">Forward to Budget</a></li>';
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.assignToAdmin('.$canvass_id.')">'.lang('btn_forward_purchasing').'</a></li>';
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.toRequisitioner('.$canvass_id.')">'.lang('btn_return_initiator').'</a></li>';
                break;
            case 3:
                $btn = $defaultbtn;
                break;
            case 4:
                $btn = $defaultbtn;
                break;
            case 5:
                $btn = $defaultbtn;
                break;
            case 6:
                $btn = $defaultbtn;
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.view_response('.$canvass_id.')">'.lang('btn_view_response').'</a></li>';
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.toRequisitioner('.$canvass_id.')">'.lang('btn_return_initiator').'</a></li>';
                break;
            case 7:
                $btn = $defaultbtn;
                break;
            case 8:
                $btn = $defaultbtn;
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.view_response('.$canvass_id.')">'.lang('btn_view_response').'</a></li>';
                $btn .= '<li class="has-action"><a href="javascript:;" onClick="xwb.assignToAdmin('.$canvass_id.')">'.lang('btn_forward_purchasing').'</a></li>';
                break;

            default:
                $btn = $defaultbtn;
                break;
        }


        
        if ($btn=="") {
            $btn = '<li>'.lang('status_no_action_required').'</li>';
        }


        $action = '<div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">'.lang('dt_action').' <span class="caret"></span>
			</button>
			<ul role="menu" class="dropdown-menu">
				'.$btn.'
			</ul>
		</div>';
        return $action;
    }



    /**
     * assigne to purchasing department
     *
     * @return json
     */
    public function assignPurchasing()
    {
        $posts = $this->input->post();
        $this->load->model('Canvasser_model', 'Canvasser');
        $c = $this->Canvasser->getCanvass($posts['canvass_id'])->row();

        $posts = $this->input->post();
        $db_data = array(
                    'status' => 14,
                    'date_updated' => date('Y-m-d H:i:s')
                    );
        $this->db->where('id', $c->request_id);
        $this->db->update('request_list', $db_data);

        $db_data = array(
                    'status' => 4,
                    'date_updated' => date('Y-m-d H:i:s')
                    );
        $this->db->where('id', $posts['canvass_id']);
        $this->db->update('canvass', $db_data);


        /* add history for tracking and emails */

        $this->xwb_purchasing->addHistory('request_list', $c->request_id, lang('hist_forward_to_purchasing'), lang('hist_forward_to_purchasing_desc'), $this->log_user_data->user_id);

        $this->load->model('user/User_model', 'User');
        $this->load->model('request/Request_model', 'Request');


        /**
         * Assigning shortcode for email
         *
         * user_to
         * user_from
         * request_id
         * message
         * po
         * item
         */
        $admins = [];
        if ($c->user_from == null) {
            $admins = $this->User->getUsersByGroup('admin')->result();
        } else {
            $admin_user = $this->User->getUser($c->user_from)->row();
            $admins[] = $admin_user;
        }


        foreach ($admins as $key => $vAdmins) {
            /* sending email notification */
            $shortcodes = array(
                    'user_to' => $vAdmins->id,
                    'message' => $this->input->post('reason'),
                    'request_id' => $c->request_id
                );

            $this->xwb_purchasing->setShortCodes($shortcodes);

            $condition = $this->xwb_purchasing->getShortCodes();

            $msg = $this->xwb_purchasing->getMessage('to_admin_review');
            $message = do_shortcode($msg['message'], $condition);
            $site_title = $this->config->item('site_title');
            $res = $this->xwb_purchasing->sendmail($condition['email_to'], $msg['subject'], $message, $condition['email_from'], $site_title, $msg['subject']);
        }
        
        $data['status'] = true;
        $data['message'] = lang('msg_forwarded_purchasing');

        $message = "Canvasser has update & forward a request to you. Kindly login to see.";
        // $message = json_encode($new_requests[1])["request name"];
        $phone = $_SERVER['sms_number'];
        $sender_id = "ADONKO LTD";
        $key = "00c44cf39580579e337c"; //your unique API key;
        $message = urlencode($message); //encode url;
        $url = "http://goldsms.smsalertgh.com/smsapi?key=$key&to=$phone&msg=$message&sender_id=$sender_id";
        file_get_contents($url); //call url and store result;

        echo $this->xwbJsonEncode($data);
    }


    /**
     * get response of the user
     *
     * @return json
     */
    public function getResponse()
    {
        $canvass_id = $this->input->post('canvass_id');
        $c = $this->Canvasser->getCanvass($canvass_id)->row();
        $data['reason'] = $c->user_response;
        echo $this->xwbJsonEncode($data);
    }



    /**
     * Responde to status
     *
     * @return type
     */
    public function respond()
    {
        $this->redirectUser();
        $this->form_validation->set_rules('canvass_id', lang('canvasser_label'), 'required|alpha_dash');
        $this->form_validation->set_rules('response', lang('response_label'), 'required');

    
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            echo $this->xwbJsonEncode($data);
            exit();
        } else {
            $this->load->model('user/User_model', 'User');
            $this->load->model('request/Request_model', 'Request');

            $posts = $this->input->post();
            $c = $this->Canvasser->getCanvass($posts['canvass_id'])->row();

            if ($c->status == 6) {
                $new_canvass_stat = 7;
                $new_req_stat = 16;
                $usertype_to = "Admin";
            } elseif ($c->status == 8) {
                $new_canvass_stat = 5;
                $new_req_stat = 17;
                $usertype_to = "Requisitioner";
            }
            
            $db_data = array(
                    'canvass_message' => $posts['response'],
                    'status' => $new_canvass_stat,
                );

            $res = $this->Request->updateRequestStatus($c->request_id, $new_req_stat);

            $res = $this->Canvasser->updateCanvass($posts['canvass_id'], $db_data);


            /**
             * Assigning shortcode for email
             *
             * user_to
             * user_from
             * request_id
             * message
             * po
             * item
             */
            $shortcodes = array(
                    'user_to' => $c->user_from,
                    'message' => $posts['response'],
                    'request_id' => $c->request_id,
                );

            $this->xwb_purchasing->setShortCodes($shortcodes);

            $condition = $this->xwb_purchasing->getShortCodes();

            /* sending email notification */
            $msg = $this->xwb_purchasing->getMessage('canvasser_to_requisitioner');

            $message = do_shortcode($msg['message'], $condition);
            $site_title = $this->config->item('site_title');
            $this->xwb_purchasing->sendmail($condition['email_to'], $msg['subject'], $message, $condition['email_from'], $site_title, $msg['subject']);

            /* Adding to history transaction */
            $this->xwb_purchasing->addHistory('canvass', $c->id, lang('hist_canvasser_response'), sprintf(lang('hist_canvasser_response'), $usertype_to), $this->log_user_data->user_id);


            if ($res) {
                $data['status'] = true;
                $data['message'] = lang('msg_responded_issue');
            } else {
                $data['status'] = false;
                $data['message'] = lang('msg_error_update_data');
            }
        }

        
        echo $this->xwbJsonEncode($data);
    }



    /**
     * Print request
     *
     * @param int $canvass_id
     * @return mixed
     */
    public function print_request($canvass_id)
    {
        $this->redirectUser(array('admin','member','canvasser','budget','auditor'));
        $this->load->model('user/User_model', 'User');
        $this->load->model('request/Request_model', 'Request');
        $this->load->model('budget/Budget_model', 'Budget');
        $this->load->model('canvasser/Canvasser_model', 'Canvasser');
        $this->load->model('purchase_order/Purchase_order_model', 'PO');
        
        $this->load->model('Branch/Branch_model', 'Branch');
        $branches = $this->Branch->getBranch()->result_array();
        $branches = array_column($branches, 'description');
        $branches = implode(' * ', $branches);

        $c = $this->Canvasser->getCanvass($canvass_id)->row();
        $request_id = $c->request_id;
        
        $items = $this->Request->getItemsPerRequestCanvasser($request_id)->result();
        $request = $this->Request->getRequest($request_id)->row();
        $requestor = $this->User->getUser($request->user_id)->row();
        $this->load->library('pdf');
        $filename = "request_$request_id";
        $pdfFilePath = FCPATH."downloads/pdf/$filename.pdf";
        $pdf = $this->pdf->load();
        $stylesheet = file_get_contents($this->config->item('assets_path').'css/pdfstyle.css');

        $req_approval = $this->Request->getReqForApprovalByRequest($request_id)->result();
        $budget = $this->Budget->getBudgetByRequest($request_id)->row();
        if ($budget == null || ($budget->status != 1 && $budget->status != 5)) {
            $budget_name = '';
            $budget_date = '';
        } else {
            $budget_name = $budget->full_name;
            $budget_date = date('F j, Y, g:i a', strtotime($budget->date_updated));
        }

        $canvasser = $this->Canvasser->getCanvassByRequest($request_id)->row();
        if ($canvasser == null || $canvasser->date_updated == null) {
            $canvass_name = '';
            $canvass_date = '';
        } else {
            $canvass_name = $canvasser->full_name;
            $canvass_date = date('F j, Y, g:i a', strtotime($canvasser->date_updated));
        }

        if ($request->status==13) {
            $approve_purchase_by = $this->User->getUser($request->approve_purchase_by)->row();
            $approve_purchase_date = date('F j, Y, g:i a', strtotime($canvasser->date_updated));
        } else {
            $approve_purchase_by = "";
            $approve_purchase_date = "";
        }


        $res_po = $this->PO->getPOByRequest($request->id)->row();

        //$pdf->SetDisplayMode('fullpage');
        ob_start();
        ?>
        <h3 class="text-center"><?php echo getConfig('company_name'); ?></h3>
        <p class="text-center"><?php echo $branches; ?></p>
        <p class="text-center"><?php echo lang('pdf_heading_purchasing_dept'); ?></p>
        
        <div class="received-date">
            <h5><?php echo lang('pdf_recieved'); ?></h5>
            <p><?php echo lang('pdf_po_date_label'); ?>: _______________</p>
            <p><?php echo lang('pdf_time_label'); ?>: _______________</p>
            <p><?php echo lang('pdf_by_label'); ?>: &emsp; _______________</p>
        </div>
        <hr />
        <h3 class="text-center"><?php echo lang('pdf_purch_req_slip'); ?></h3>
        <p class="underline width-150 pull-left clearfix"><b><?php echo lang('pdf_pr_num'); ?>: </b><?php echo sprintf('PR-%08d', $request->id); ?></p>
        <p class="underline width-150 pull-left clearfix"><b><?php echo lang('pdf_po_num'); ?>: </b><?php echo ($res_po==null?"":sprintf('PO-%08d', $res_po->id)); ?></p>
        
        <br />
        <br />
        <table border="1" cellpadding="1" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" width="5%" rowspan="4">
                        <?php echo lang('dt_heading_quantity'); ?>
                    </th>
                    <th align="center" width="5%" rowspan="4">
                        <?php echo lang('dt_heading_unit'); ?>
                    </th>
                    <th align="center" width="15%" rowspan="4">
                        <?php echo lang('dt_items'); ?>
                    </th>
                    <th align="center" width="20%" rowspan="4">
                        <?php echo lang('dt_heading_item_description'); ?>
                    </th>
                    <th colspan="4" width="65%"><h5><?php echo lang('pdf_purch_use_only'); ?></h5></th>
                </tr>
                <tr>
                    <th colspan="4" width="65%"><h5><?php echo lang('pdf_quotations_label'); ?></h5></th>
                </tr>
                <tr>
                    <th width="16.25%"><h5><?php echo lang('pdf_name_supplier_unit'); ?></h5></th>
                    <th width="16.25%"><h5><?php echo lang('pdf_name_supplier_unit'); ?></h5></th>
                    <th width="16.25%"><h5><?php echo lang('pdf_name_supplier_unit'); ?></h5></th>
                    <th width="16.25%"><h5><?php echo lang('pdf_name_supplier_unit'); ?></h5></th>
                </tr>
                <tr>
                    <th width="16.25%"><h5> &nbsp; </h5></th>
                    <th width="16.25%"><h5> &nbsp; </h5></th>
                    <th width="16.25%"><h5> &nbsp; </h5></th>
                    <th width="16.25%"><h5> &nbsp; </h5></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                $sum = 0;
                $column_1 = $column_2 = $column_3 = $column_4 = 0;
                foreach ($items as $key => $value) :
                ?>
                <?php
                    $supplier = getSuplliersFromCanvassed($value->request_id, $value->product_id, $value->product_name);
                    $supplier_num = $supplier->num_rows();
                    $supplier = $supplier->result();
                    $supplier_1 = null;
                    $supplier_2 = null;
                    $supplier_3 = null;
                    $supplier_4 = null;
                for ($i=0; $i < $supplier_num; $i++) {
                    $post_var = $i+1;
                    ${'supplier_'.$post_var} = $supplier[$i];
                }
                    $row_total = 0;
                ?>
                    <tr>

                        <!-- <td><?php echo $counter; ?></td> -->
                        <td><?php echo $value->quantity; ?></td>
                        <td><?php echo $value->unit_measurement; ?></td>
                        <td><?php echo $value->product_name; ?></td>
                        <td>
                        <p class="label">
                            <?php echo $value->product_description; ?>
                        </p>
                        </td>
                        <td>
                            <?php
                                $supplier = (isset($supplier_1)?$supplier_1:null);
                                $cp_status = (is_null($supplier)?null:$supplier->cp_status);
                                $po_item_id = ($cp_status == null?'new1_'.$value->id:$supplier->id.'_'.$supplier->cp_id);
                                $supplier_id = (is_null($supplier)?null:$supplier->supplier_id);

                                $supplier_name = (is_null($supplier)?null:$supplier->supplier);
                                $unit_price = (is_null($supplier)?0:$supplier->price);
                                $quantity = (is_null($supplier)?0:$supplier->quantity);
                                $row_total = $row_total + ($unit_price * $quantity);
                                $column_1 = $column_1 + ($cp_status==1?($unit_price * $quantity):0);
                            ?>
                            <?php
                            if (($unit_price*$quantity) != 0) :
                            ?>
                            <p class="label text-center"><?php echo $cp_status==1?'<b class="text-12">&#10004;</b>':''; ?><?php echo $supplier_name; ?> </p>
                            <p class="label"><?php echo number_format($unit_price, 2, '.', ',')." * ".$quantity; ?></p>
                            <?php
                            endif;
                            ?>
                        </td>
                    
                        <td>
                            <?php
                                $supplier = (isset($supplier_2)?$supplier_2:null);
                                $cp_status = (is_null($supplier)?null:$supplier->cp_status);
                                $po_item_id = ($cp_status == null?'new2_'.$value->id:$supplier->id.'_'.$supplier->cp_id);
                                $supplier_id = (is_null($supplier)?null:$supplier->supplier_id);

                                $supplier_name = (is_null($supplier)?null:$supplier->supplier);
                                $unit_price = (is_null($supplier)?0:$supplier->price);
                                $quantity = (is_null($supplier)?0:$supplier->quantity);
                                $row_total = $row_total + ($unit_price * $quantity);
                                $column_2 = $column_2 + ($cp_status==1?($unit_price * $quantity):0);
                            ?>
                            <?php
                            if (($unit_price*$quantity) != 0) :
                            ?>
                            <p class="label text-center"><?php echo $cp_status==1?'<b class="text-12">&#10004;</b>':''; ?><?php echo $supplier_name; ?> </p>
                            <p class="label"><?php echo number_format($unit_price, 2, '.', ',')." * ".$quantity; ?></p>
                            <?php
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                                $supplier = (isset($supplier_3)?$supplier_3:null);
                                $cp_status = (is_null($supplier)?null:$supplier->cp_status);
                                $po_item_id = ($cp_status  == null?'new3_'.$value->id:$supplier->id.'_'.$supplier->cp_id);
                                $supplier_id = (is_null($supplier)?null:$supplier->supplier_id);

                                $supplier_name = (is_null($supplier)?null:$supplier->supplier);
                                $unit_price = (is_null($supplier)?0:$supplier->price);
                                $quantity = (is_null($supplier)?0:$supplier->quantity);
                                $row_total = $row_total + ($unit_price * $quantity);
                                $column_3 = $column_3 + ($cp_status==1?($unit_price * $quantity):0);
                            ?>
                            <?php
                            if (($unit_price*$quantity) != 0) :
                            ?>
                            <p class="label text-center"><?php echo $cp_status==1?'<b class="text-12">&#10004;</b>':''; ?><?php echo $supplier_name; ?> </p>
                            <p class="label"><?php echo number_format($unit_price, 2, '.', ',')." * ".$quantity; ?></p>
                            <?php
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                                $supplier = (isset($supplier_4)?$supplier_4:null);
                                $cp_status = (is_null($supplier)?null:$supplier->cp_status);
                                $po_item_id = ($cp_status == null?'new4_'.$value->id:$supplier->id.'_'.$supplier->cp_id);
                                $supplier_id = (is_null($supplier)?null:$supplier->supplier_id);
                                
                                $supplier_name = (is_null($supplier)?null:$supplier->supplier);
                                $unit_price = (is_null($supplier)?0:$supplier->price);
                                $quantity = (is_null($supplier)?0:$supplier->quantity);
                                $row_total = $row_total + ($unit_price * $quantity);
                                $column_4 = $column_4 + ($cp_status==1?($unit_price * $quantity):0);
                            ?>
                            <?php
                            if (($unit_price*$quantity) != 0) :
                            ?>
                            <p class="label text-center"><?php echo $cp_status==1?'<b class="text-12">&#10004;</b>':''; ?><?php echo $supplier_name; ?> </p>
                            <p class="label"><?php echo number_format($unit_price, 2, '.', ',')." * ".$quantity; ?></p>
                            <?php
                            endif;
                            ?>
                        </td>
                    </tr>
                <?php
                $counter++;
                endforeach; ?>
                <tr></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8"> &nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" align="right"><strong><?php echo lang('pdf_total_label'); ?>: </strong></td>
                    <td><strong><?php echo number_format($column_1, 2, '.', ','); ?></strong></td>
                    <td><strong><?php echo number_format($column_2, 2, '.', ','); ?></strong></td>
                    <td><strong><?php echo number_format($column_3, 2, '.', ','); ?></strong></td>
                    <td><strong><?php echo number_format($column_4, 2, '.', ','); ?></strong></td>
                </tr>
                <tr bgcolor="#bcfbff">
                    <td colspan="7" align="right"><strong><?php echo lang('pdf_total_label'); ?>: </strong></td>
                    <td><strong><?php echo number_format($c->total_amount, 2, '.', ','); ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <br />
        <hr />
        <br />
        <div class="col-md-4">
            <div class="border">
                <p><b><?php echo lang('reqname_purpose'); ?>:</b></p>
                <?php echo $request->purpose;?>
                <hr />
                <p><b><?php echo lang('pdf_requested_by'); ?>:</b></p>
                <br />
                <p class="underline"><?php echo ucwords($requestor->first_name." ".$requestor->last_name); ?></p>
                <p class="label text-center"><?php echo lang('pdf_sign_over_printed'); ?></p>
                <hr />
                <p class="text-10"><b><?php echo lang('pdf_dept_branch'); ?>:</b></p>
                <p><?php echo $requestor->dep_description." / ".$requestor->branch_description;?></p>
                <hr />
                <p><b><?php echo lang('date_prepared'); ?>:</b></p>

                <p><?php echo date('F j, Y, g:i a', strtotime($request->date_updated)); ?></p>

                <hr />
                <p><b><?php echo lang('pdf_recommending_approval'); ?>:</b></p>
                <?php foreach ($req_approval as $key => $value) : ?>
                    <br />
                    <p class="upperline text-center text-12"><?php echo ucwords($value->head_name)." / ".$value->head_department; ?></p>
                <?php endforeach; ?>

                <p class="upperline label text-center"><?php echo lang('pdf_recommending_approval'); ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border">
                <div class="border">
                    <p><b><?php echo lang('pdf_with_budget'); ?>:<b></p><br />
                    <p class="underline"><b><?php echo lang('pdf_by_label'); ?>:</b><?php echo getConfig('with_budget'); ?></p>
                    <br />
                    <p><b><?php echo lang('pdf_po_date_label'); ?>:</b>____________________________</p>
                    <br />
                </div>
                <br />
                <p><b><?php echo lang('pdf_budget_certified_by'); ?>:</b></p><br />
                <p class="text-center"><?php echo (getConfig('budget_certified_by')==""?$budget_name:getConfig('budget_certified_by')) ?></p>
                <p class="upperline text-center text-10"><?php echo lang('pdf_head_budget_dept'); ?></p>
                <hr />
                <p class="underline"><b><?php echo lang('pdf_po_date_label'); ?>: </b> <?php echo $budget_date; ?></p>
                <br />
            </div>
        </div>
        <div class="col-md-4">
            <div class="border">

                <p><b><?php echo lang('pdf_canvassed_by'); ?>:</b></p>
                <p class="text-center"><?php echo ucwords($canvass_name); ?></p>
                <p class="upperline text-center text-10"><?php echo lang('pdf_heading_purchasing_dept'); ?></p>

                <hr />
                <p class="underline"><b><?php echo lang('pdf_po_date_label'); ?>:</b><?php echo $canvass_date;?></p><br />
                <br />
                <hr />
                <p><b><?php echo lang('pdf_approve_purchased_by'); ?>:</b></p><br />

                <p class="text-center"><?php echo getConfig('approve_purchased_by'); /*$approve_purchase_by;*/ ?></p>
                <p class="upperline text-center text-10"><?php echo lang('pdf_head_purchasing_dept'); ?></p>

                <hr />
                <p class="underline"><b><?php echo lang('pdf_po_date_label'); ?>:</b><?php echo $approve_purchase_date; ?></p><br />
            </div>
        </div>


        <?php
        $html = ob_get_contents();
        ob_end_clean();
        $pdf->SetTitle($request->request_name);
        $pdf->WriteHTML($stylesheet, 1);
        $pdf->WriteHTML($html);
        $pdf->Output();
    }


    public function returnRequisitioner()
    {
        $this->redirectUser();
        $this->form_validation->set_rules('canvass_id', lang('canvasser_label'), 'required|alpha_dash');
        $this->form_validation->set_rules('message', lang('message_label'), 'required');

    
        if ($this->form_validation->run() == false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            echo $this->xwbJsonEncode($data);
            exit();
        } else {
            $this->load->model('user/User_model', 'User');
            $this->load->model('request/Request_model', 'Request');

            $posts = $this->input->post();
            $c = $this->Canvasser->getCanvass($posts['canvass_id'])->row();
            $r = $this->Request->getRequest($c->request_id)->row();
            $db_data = array(
                    'canvass_message' => $posts['message'],
                    'status' => 5,
                );

            $res = $this->Request->updateRequestStatus($c->request_id, 17);

            $res = $this->Canvasser->updateCanvass($posts['canvass_id'], $db_data);


            /**
             * Assigning shortcode for email
             *
             * user_to
             * user_from
             * request_id
             * message
             * po
             * item
             */
            $shortcodes = array(
                    'user_to' => $r->user_id,
                    'message' => $this->input->post('message'),
                    'request_id' => $c->request_id,
                );

            $this->xwb_purchasing->setShortCodes($shortcodes);

            $condition = $this->xwb_purchasing->getShortCodes();

            /* sending email notification */
            $msg = $this->xwb_purchasing->getMessage('admin_to_requisitioner');
            $message = do_shortcode($msg['message'], $condition);
            $site_title = $this->config->item('site_title');
            $this->xwb_purchasing->sendmail($condition['email_to'], $msg['subject'], $message, $condition['email_from'], $site_title, $msg['subject']);


            $this->xwb_purchasing->addHistory('canvass', $posts['canvass_id'], lang('hist_canvasser_to_initiator'), lang('hist_canvasser_to_initiator_desc'), $this->log_user_data->user_id);
            if ($res) {
                $data['status'] = true;
                $data['message'] = lang('msg_req_to_initiator');
            } else {
                $data['status'] = false;
                $data['message'] = lang('msg_error_newreq');
            }
        }

        
        echo $this->xwbJsonEncode($data);
    }



    

    /**
     * Get list of supplier with total amount
     *
     * @return json
     */
    public function supplierSummary()
    {
        $this->load->model('item/Item_model', 'Item');
        $request_id = $this->input->get('request_id');
        if (!$request_id) {
            $canvass_id = $this->input->get('canvass_id');
            $c = $this->Canvasser->getCanvass($canvass_id)->row();
            $request_id = $c->request_id;
        }
        
        $res = $this->Item->supplierSummary($request_id);

        $data['data'] = array();

        if ($res->num_rows()>0) {
            $total_amount = 0;
            foreach ($res->result() as $key => $v) {
                $total_amount = $total_amount + $v->total_amount;
                $data['data'][] = array(
                                        $v->supplier,
                                        number_format($v->total_amount, 2, '.', ','),
                                        );
            }
            $data['footer'] = '<tr><td align="right"><strong class="pull-left">'.lang('dt_total_label').'</strong></td><td><strong>'.number_format($total_amount, 2, '.', ',').'</strong></td></tr>';
        }
        echo $this->xwbJsonEncode($data);
    }
}
