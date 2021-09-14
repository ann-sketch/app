<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Purchasing language - english
*
* Author: Jay-r Simpron <ssj.simpron@gmail.com>
*
*
* Location: https://codecanyon.net/user/jaystream
*
* Created:  03.08.2019
*
* Description:  English language file for CIPurchasing system
*
*/

// Dashbord

$lang['dashboard_page_title'] = 'Dashboard';
$lang['graph_legend_title'] = 'Requests';

$lang['new_requests_tile'] = 'New Requests';
$lang['new_requests_tile_sub_heading'] = 'Requests created by Users subject for approval';
$lang['head_tile'] = 'Head / Recomemnding Approval';
$lang['head_tile_sub_heading'] = 'Requests for approval by the Department Head';
$lang['canvass_tile'] = 'Canvass';
$lang['canvass_tile_sub_heading'] = 'Requests processed and endorsed for canvassing';
$lang['budget_tile'] = 'Budget Approval';
$lang['budget_tile_sub_heading'] = 'Requests pending Budget Approval';

$lang['graph_request_created_heading'] = 'Request Created';
$lang['graph_progress_heading'] = '1 Week progress';

$lang['users_requested_heading'] = 'Users Requested';

$lang['progress_encode_new_req'] = 'Encode New Request';
$lang['progress_head_approval'] = 'Head/Recommending Approval';
$lang['progress_canvassing'] = 'Canvassing';
$lang['progress_board_budget_approval'] = 'Budget/Board Approval';
$lang['progress_purchasing'] = 'Purchasing';
$lang['progress_done'] = 'Done';
$lang['lbl_menu'] = 'Menu';

// Purchase order page
$lang['po_page_title'] = 'Purchase Order';
$lang['po_update_page_title'] = 'Update Purchase Order';
$lang['gen_po_page_title'] = 'Generate Purchase Order';
$lang['supplier_label'] = 'Supplier';
$lang['select_supplier_label'] = 'Select Supplier';
$lang['select_user'] = 'Select User';
$lang['req_cat_label'] = 'Request Category';
$lang['select_req_cat'] = 'Select Request Category';
$lang['date_label'] = 'Date';
$lang['date_prepared'] = 'Date Prepared';
$lang['po_num_label'] = 'P.O. #';
$lang['pr_num_label'] = 'P.R. #';
$lang['customer_num_label'] = 'Customer Number';
$lang['date_issue_label'] = 'Date Issue';
$lang['supplier_invoice_label'] = 'Supplier Invoice';
$lang['rr_num_label'] = 'R.R. No.';
$lang['delivery_date_label'] = 'Delivery Date';
$lang['payment_terms_label'] = 'Terms of Payment';
$lang['warranty_condition_label'] = 'Condition of warranty';
$lang['penalty_clause_label'] = 'Penalty Clause';
$lang['initiator_label'] = 'Requisitioner';
$lang['approved_by'] = 'Approved By';
$lang['select_auditor'] = 'Select Auditor';
$lang['request_id'] = 'Request ID';
$lang['note_to_auditor'] = 'Note to Auditor';


/*= = ============ Request pages ================== = = */
$lang['request_list_page_title'] = 'Request List';
$lang['request_list_heading_info'] = "If your request is denied, you can view the message or reason in the detailed view on your request by clicking the link in 'Type of Request' column";
$lang['request_label'] = 'Request';
$lang['response_label'] = 'Response';
$lang['row_number'] = 'Row Number';
$lang['approval_id'] = 'Approval ID';

// View request page
$lang['item_status_page_title'] = 'Item Status';
$lang['heading_current_status'] = 'Current Status';
$lang['status_no_action_required'] = 'No Action Required';
$lang['heading_request_details'] = 'Request Details';


// New request
$lang['newreq_page_title'] = 'New Request';
$lang['menu_request_new'] = 'Request New';
$lang['menu_all_req'] = 'All Requests';
$lang['menu_my_req'] = 'My Requests';
$lang['menu_archive'] = 'Archived';
$lang['newreq_step1'] = 'Step 1';
$lang['newreq_step1_subheading'] = 'Request Information';
$lang['newreq_step2'] = 'Step 2';
$lang['newreq_step2_subheading'] = 'Request Items';
$lang['newreq_step3'] = 'Step 3';
$lang['newreq_step3_subheading'] = 'Verify Request';
$lang['reqname_label'] = 'Type of Request';
$lang['purchase_num'] = 'Purchase No.';
$lang['reqname_purpose'] = 'Purpose';
$lang['select_product'] = 'Select Product';
$lang['department_label'] = 'Department';
$lang['lbl_item'] = 'Item';


// Create PO page
$lang['create_po_page_title'] = 'Create Purchase Order';

// Head approval page
$lang['head_remarks_label'] = 'Department Head remarks';
$lang['page_headapproval_title'] = 'Request for approval';
$lang['menu_head_approval'] = 'Head approval';
$lang['remarks_label'] = 'Remarks';

// Staff request
$lang['staff_req_page_title'] = 'Staff Request';

// Archive page
$lang['archive_page_title'] = 'Request Archive List';

/*Head For approval page*/
$lang['head_heading_info'] = 'Click the "View Items" to approve or deny each item';


// head/recommending approval page
$lang['recommending_page_title'] = 'Recommending approval';
$lang['recommending_title_info'] = 'After assigning to the head users, you can click the “back” button to go back to the list of head approval request.';
$lang['recommending_user_panel_info'] = 'These users are the head of all the department.';
$lang['select_head_user'] = 'Select Head User';
$lang['recommending_item_panel_info'] = 'Check an item(s) you want to assign to the selected head user';
$lang['check_all'] = 'Check all';
$lang['recommending_list_panel'] = 'List';
$lang['recommending_list_panel_info'] = 'These are the assigned items of the selected head user';


/*Board page*/
$lang['board_page_title'] = 'Request for Board Approval';
$lang['board_approval'] = 'Board Approval';
$lang['menu_board_approval'] = 'Board Approval';

/*History page*/
$lang['hist_page_title'] = 'History';
$lang['menu_history'] = 'Transaction History';

/*Report page*/
$lang['reqreport_page_title'] = 'Request Reports';
$lang['menu_reports'] = 'Reports';
$lang['menu_staff_reports'] = 'Staff Reports';
$lang['label_all'] = 'All';
$lang['label_year'] = 'Year';
$lang['label_month'] = 'Month';
$lang['label_month_date'] = 'Month/Date';

/*Reports page*/
$lang['staff_reqreport_page_title'] = 'Staff Request Reports';
$lang['item_report_page_title'] = 'Items Reports';
$lang['staff_item_report_page_title'] = 'Staff Item Reports';
$lang['menu_item_reports'] = 'Item Reports';
$lang['po_report_page_title'] = 'PO Reports';
$lang['staff_po_report_page_title'] = 'Staff PO Reports';

/*Settings page*/
$lang['settings_page_title'] = 'Settings';
$lang['menu_gen_settings'] = 'General Settings';
$lang['menu_status'] = 'Status';
$lang['php_version'] = 'PHP Version';
$lang['headig_company_profile'] = 'Company Profile';
$lang['label_upload_logo'] = 'Upload Logo';
$lang['upload_logo_help'] = 'Max( width:500pixel, height:300pixel, size: 1MB )';
$lang['upload_logo_instruction'] = 'Please make the assets/ writable.';
$lang['text_example'] = 'Example';
$lang['upload_logo_command'] = 'sudo chmod -R 777 assets';
$lang['upload_attachment_instruction'] = 'Please make the storage/temp/ writable.';
$lang['upload_attachment_command'] = 'sudo chmod -R 777 storage/temp';
$lang['upload_folder_instruction'] = 'Please make the storage/uploads/ writable.';
$lang['upload_folder_command'] = 'sudo chmod -R 777 storage/uploads';
$lang['mpdf_writable_instruction'] = 'Please make the vendor/mpdf/mpdf/tmp/ writable.';
$lang['mpdf_writable_command'] = 'sudo chmod -R 777 vendor/mpdf/mpdf/tmp';

$lang['lbl_company_name'] = 'Company Name';
$lang['lbl_company_address'] = 'Company Address';
$lang['lbl_company_phone'] = 'Company Phone';
$lang['settings_po_info'] = 'This will appear in the Purchase Order print PDF';
$lang['lbl_po_penalty_clause'] = 'P.O. Penalty Clause';
$lang['lbl_po_note'] = 'P.O. Note';
$lang['lbl_po_reminder'] = 'P.O. Reminder';
$lang['heading_print_req'] = 'Print Request';
$lang['settings_printreq_info'] = 'These are the name of the person that will show on Print Request Form PDF';
$lang['lbl_announcement'] = 'Announcement';
$lang['dashboard_miscellaneous'] = 'Miscellaneous';
$lang['lbl_board_approval_amount'] = 'Board approval amount';
$lang['lbl_board_approval_amount_info'] = 'Forward to board when total amount reached more than the specified amount';
$lang['lbl_logo_to_use'] = 'Logo to use';
$lang['text_logo'] = 'Logo';
$lang['text_company_name'] = 'Company Name';
$lang['lbl_show_default_user'] = 'Show default users in login';
$lang['lbl_email_notif'] = 'Email Notification';
$lang['txt_enabled'] = 'Enabled';
$lang['txt_disabled'] = 'Disabled';

// Console page
$lang['console_page_title'] = 'Console';

// Emails page
$lang['emails_page_title'] = 'Email Messages';
$lang['txt_shortcode_ref'] = 'Shortcodes Reference';
$lang['email_page_info'] = 'These are the predefined email messages template on each process. All you need to do is to edit the content of the email if necessary';
$lang['heading_process'] = 'Process';
$lang['label_process_key'] = 'Process Key';
$lang['label_email_msg'] = 'Email Message';

// Status page
$lang['page_status_title'] = 'Status Settings';
$lang['page_status_info'] = 'Please do not delete any status unless you know what you are doing';
$lang['lbl_status_id'] = 'Status ID';

// Users page
$lang['page_user_title'] = 'Users';
$lang['lbl_user_type'] = 'User Type';
$lang['lbl_department_head'] = 'Department Head';
$lang['dept_head_check'] = 'Check this if you want to assign this user as department head';
$lang['lbl_phone'] = 'Phone';
$lang['lbl_pass'] = 'Password';
$lang['lbl_confirm_pass'] = 'Confirm Password';
$lang['lbl_old_pass'] = 'Old Password';
$lang['lbl_new_pass'] = 'New Password';
$lang['lbl_confirm_pass'] = 'Confirm Password';
$lang['txt_activate'] = 'Activate';
$lang['txt_deactivate'] = 'Deactivate';

// Uer group page
$lang['page_ugroup_title'] = 'User Group';
$lang['lbl_name'] = 'Name';
$lang['lbl_description'] = 'Description';

// Department page
$lang['page_department_title'] = 'Department';

// Branch page
$lang['page_branch_title'] = 'Branches';

// Supplier page
$lang['page_supplier_title'] = 'Supplier';
$lang['lbl_supplier_name'] = 'Supplier Name';
$lang['lbl_email'] = 'Email';

// Product page
$lang['page_product_title'] = 'Products';
$lang['lbl_no_category'] = 'No Category';
$lang['lbl_product_category'] = 'Product Category';

// Product Category page
$lang['page_productcat_title'] = 'Product Category';
$lang['lbl_parent_cat'] = 'Parent Category';

// Request category page
$lang['page_reqcat_title'] = 'Request Category';

/* User Profile page */
$lang['page_profile_title'] = 'User Profile';
$lang['nav_profile'] = 'Profile';
$lang['nav_logout'] = 'Log Out';
$lang['profile_pic_info'] = 'Max( width:1000pixel, height:1000pixel, size: 2MB )';
$lang['profile_pic_chmod'] = 'Please make the storage/images/ writable. <br /><strong>Example</strong>:<code>sudo chmod -R 777 storage/images/</code>';
$lang['lbl_upload_profilepic'] = 'Upload Profile Picture';
$lang['lbl_fname'] = 'First Name';
$lang['lbl_lname'] = 'Last Name';
$lang['lbl_username'] = 'Username';
$lang['lbl_changepass'] = 'Change Password';
$lang['lbl_your_curr_pass'] = 'Enter your current password';
$lang['lbl_currpass'] = 'Current Password';

/* Help Page */
$lang['page_help_title'] = 'Help';
$lang['lbl_process_manual'] = 'Process Manual';
$lang['lbl_member_user_manual'] = 'Members User Manual';
$lang['lbl_canvasser_user_manual'] = 'Canvasser User Manual';
$lang['lbl_budget_user_manual'] = 'Budget User Manual';
$lang['lbl_auditor_user_manual'] = 'Auditor User Manual';
$lang['lbl_admin_user_manual'] = 'Admin User Manual';
$lang['lbl_property_user_manual'] = 'Property User Manual';
$lang['lbl_cash'] = 'Cash';
$lang['lbl_open_account'] = 'Open Account';
$lang['lbl_secured_account'] = 'Secured Account';


/* Page Auditor */
$lang['page_auditor_title'] = 'Auditor';
$lang['heading_announcement'] = 'Announcement';
$lang['page_auditlist_title'] = 'Audit List';
$lang['menu_for_audit'] = 'For Audit';

/* Budget Page */
$lang['page_reqapproval_title'] = 'Request Approval';
$lang['lbl_budget'] = 'Budget';
$lang['menu_budget_approval'] = 'Budget Approval';

/* Canvasser */
// My Request
$lang['page_canvass_myrequest_title'] = 'Purchase Request';
$lang['page_canvass_assigned_title'] = 'Assigned Request';
$lang['page_canvass_assigned_info'] = 'Click action->update item for canvassing system';
$lang['menu_req_assigned'] = 'Requests Assigned';

// Update item
$lang['page_updateitem_title'] = 'Products/Items';
$lang['lbl_initial_canvass_date'] = 'Initial Canvass Date';
$lang['heading_canvassed_items'] = 'Canvassed Items / Products';

/* Property page */
$lang['page_property_title'] = 'Property';
$lang['page_property_reqdone_title'] = 'Request Done';
$lang['lbl_date_received'] = 'Date Received';
$lang['lbl_property'] = 'Property';

// Buttons languages
$lang['btn_update'] = 'Update';
$lang['btn_update_items'] = 'Update Items';
$lang['btn_preview_po'] = 'Preview PO';
$lang['btn_view'] = 'View';
$lang['btn_view_items'] = 'View Items';
$lang['btn_back'] = 'Back';
$lang['btn_newreq'] = 'New Request';
$lang['btn_close'] = 'Close';
$lang['btn_upload'] = 'Upload';
$lang['btn_add_item'] = 'Add Item';
$lang['btn_file_newreq'] = 'File Request';
$lang['btn_next'] = 'Next';
$lang['btn_previous'] = 'Previous';
$lang['btn_remove'] = 'Remove';
$lang['btn_remove_item'] = 'Remove Item';
$lang['btn_attachment'] = 'Attachment';
$lang['btn_edit'] = 'Edit';
$lang['btn_delete'] = 'Delete';
$lang['btn_print_req'] = 'Print Request';
$lang['btn_submit'] = 'Submit';
$lang['btn_save'] = 'Save';
$lang['btn_assign'] = 'Assign';
$lang['btn_deny'] = 'Deny';
$lang['btn_done'] = 'Done';
$lang['btn_supplier_summary'] = 'Supplier Summary';
$lang['btn_view_request'] = 'View Request';
$lang['btn_view_message'] = 'View Message';
$lang['btn_to_canvass'] = 'Forward to Canvasser';
$lang['btn_to_initiator'] = 'Forward to Requisitioner';
$lang['btn_expenditure'] = 'Expenditure';
$lang['btn_gen_po'] = 'Generate PO';
$lang['btn_partial_done'] = 'Partially Done';
$lang['btn_archive'] = 'Archive';
$lang['btn_assign_budget'] = 'Assign to Budget';
$lang['btn_return_canvasser'] = 'Return to Canvasser';
$lang['btn_view_response'] = 'View Response';
$lang['btn_view_reason_respond'] = 'View Reason and Respond';
$lang['btn_approve_all'] = 'Approve All';
$lang['btn_approve'] = 'Approve';
$lang['btn_delete_as_approving'] = 'Delete as Approving Officer';
$lang['btn_unarchive'] = 'UnArchive';
$lang['btn_download'] = 'Download';
$lang['btn_respond'] = 'Respond';
$lang['btn_recommending_approval'] = 'Recommending Approval';
$lang['btn_set_postart'] = 'Set PO number start';
$lang['btn_set_prstart'] = 'Set PO number start';
$lang['btn_add_status'] = 'Add Status';
$lang['btn_add_user'] = 'Add User';
$lang['btn_change_pass'] = 'Change Password';
$lang['btn_change'] = 'Change';
$lang['btn_add_department'] = 'Add Department';
$lang['btn_add_branch'] = 'Add Branch';
$lang['btn_add_supplier'] = 'Add Supplier';
$lang['btn_add_product'] = 'Add Product';
$lang['btn_add'] = 'Add';
$lang['btn_return_initiator'] = 'Return to Requisitioner';
$lang['btn_forward_purchasing'] = 'Forward to Admin';
$lang['btn_received'] = 'Received';
$lang['btn_forward_budget'] = 'Forward to Budget';
$lang['btn_assigned_items'] = 'Assigned Items';
$lang['btn_update_database'] = 'Update Database';


// History record languages
$lang['forwarded_to_audit'] = 'Forward to audit';
$lang['forwarded_to_audit_desc'] = 'Forwarded to audit for review';
$lang['hist_reupdate_po'] = 'Reupdate PO';
$lang['hist_reupdate_po_desc'] = 'Reupdated the PO for audit review';
$lang['hist_newreq'] = 'Created a new Request';
$lang['hist_assign_to_canvasser'] = 'Assigned to Canvasser';
$lang['hist_initiator_responded'] = 'Requisitioner Responded';
$lang['hist_initiator_responded_budget'] = 'User responded to budget';
$lang['hist_initiator_responded_board'] = 'Requisitioner Response to Board';
$lang['hist_initiator_responded_canvasser'] = 'Requisitioner Response to canvasser';
$lang['hist_initiator_responded_admin'] = 'Requisitioner Response to Admin';
$lang['hist_request_done'] = 'Request Done';
$lang['hist_request_approved'] = 'Request Approved';
$lang['hist_initiator_responded_head'] = 'User respond to Head/Recommending approval';
$lang['hist_return_to_canvass'] = 'Return to Canvasser';
$lang['hist_return_to_canvass_desc'] = 'Return to Canvasser for edit';
$lang['hist_forward_budget'] = 'Forwarded to Budget';
$lang['hist_forward_budget_desc'] = 'Forwarded to budget for approval';
$lang['hist_item_removed'] =  'Item Removed';
$lang['hist_item_removed_desc'] =  '%s has been removed';
$lang['hist_to_initiator'] =  'Return to Requesitioner';
$lang['hist_to_initiator_desc'] =  'Request returned to requisitioner';
$lang['hist_request_filed'] =  'Request Filed';
$lang['hist_request_filed_desc'] =  'Request Filed: Head/Recommending Department approve the request';
$lang['hist_board_denied'] =  'Board Denied';
$lang['hist_board_denied_desc'] =  'Request Denied by board';
$lang['hist_board_approved'] =  'Board Approved';
$lang['hist_board_approved_desc'] =  'Board approved the request id %s';
$lang['hist_audit_to_purchasing'] =  'Return to purchasing';
$lang['hist_forward_to_purchasing'] =  'Forwarded to Purchasing';
$lang['hist_forward_to_purchasing_desc'] =  'Forwarded to purchasing department for approval';
$lang['hist_audit_to_purchasing_desc'] =  'Return to Purchase Order to purchasing department';
$lang['hist_budget_denied'] ='Budget Denied';
$lang['hist_budget_denied_desc'] ='Budget approval denied';
$lang['hist_budget_approved'] ='Budget Approved';
$lang['hist_budget_approved_desc'] ='Request budget approved';
$lang['hist_canvasser_response'] ='Canvasser Response';
$lang['hist_canvasser_response_desc'] = 'Canvasser Response to %s';
$lang['hist_canvasser_to_initiator'] ='Canvasser to Requisitioner';
$lang['hist_canvasser_to_initiator_desc'] ='Request return from canvasser to requisitioner';
// System message languages
$lang['msg_success_update_po'] = 'Purchase order updated';
$lang['msg_delete_attachment'] = 'Are you sure you want to delete this attachment?';
$lang['msg_newreq_verify_info'] = 'The request cannot be submitted if there is no department head to approve the request.';
$lang['msg_error_update_profile'] = 'Error: Please update your profile.';
$lang['msg_error_no_head'] = 'There is no head assigned on your department yet, please call the purchasing department regarding this error.';
$lang['msg_error_newreq'] = 'Error saving to database, please contact the programmer"';
$lang['msg_error_newreq_nodata'] = 'No data has been set. Please try creating a new request';
$lang['msg_success_newreq'] = 'Request has been sent for department head approval';
$lang['status_head_denied'] = 'Head/Recommending approval denied';
$lang['msg_req_updated'] = 'Request has been successfully updated.';
$lang['msg_req_num_updated'] = 'Purchase Request # has been updated';
$lang['msg_item_updated'] = 'Item has been successfully updated.';
$lang['msg_items_updated'] = 'Item has been successfully updated.';
$lang['msg_req_added'] = 'Request has been successfully added.';
$lang['msg_success_req_deleted'] = 'Request has been deleted';
$lang['msg_error_req_deleted'] = 'Error deleting record, please contact the system programmer';
$lang['msg_error_delete_file'] = 'Error deleting file, Please contact the system programmer';
$lang['msg_move_to_archive'] = 'Are you sure you want to move this request ot archive?';
$lang['msg_moved_to_archive'] = 'Request has been archived';
$lang['msg_restore_archive'] = 'Are you sure you want to restore this request?';
$lang['msg_assign_to_canvass'] = 'Request has been assigned to canvasser';
$lang['msg_req_denied'] = 'Request has been denied';
$lang['msg_approve_to_purchasing'] = 'Request has been approved and file to purchasing department';
$lang['msg_unauthorize_access'] = 'Unauthorized Access or Request Can not be edited at this stage';
$lang['msg_responded_issue'] = 'You have responded the issue';
$lang['msg_no_item_tobe_updated'] = 'No Item to be updated';
$lang['msg_error_update_data'] = 'Error updating data, pelase contact the programmer';
$lang['msg_error_update_no_input'] = 'Error updating data, No input found';
$lang['msg_attachment_uploaded'] = 'Attachment uploaded';
$lang['msg_attachment_removed'] = 'Attachment Removed';
$lang['msg_responded_head'] = 'You have successfully responded to head/recommending approval';
$lang['msg_req_to_canvass'] = 'Request returned to canvasser';
$lang['msg_req_to_initiator'] = 'Request successfully return to requisitioner';
$lang['msg_forwarded_budget'] = 'Request has been forwarded to budget for approval';
$lang['msg_item_deleted'] = 'Item successfully deleted';
$lang['msg_deleted_record'] = 'Are you sure you want to delete this record?';
$lang['msg_approviing_officer_delete'] = 'Approving officer has been deleted';
$lang['msg_item_approved'] = 'Item Approved';
$lang['msg_item_denied'] = 'Item Denied';
$lang['msg_items_approved'] = 'Items Approved';
$lang['msg_items_approved_locking_request'] = 'All items approved, locking the request...';
$lang['msg_approve_request'] = 'Are you sure you want to approve this request?';
$lang['msg_board_approved'] = 'Board Approved, Processing request...';
$lang['msg_settings_updated'] = 'Settings updated';
$lang['msg_logo_updated'] = 'Logo updated';
$lang['msg_email_updated'] = 'Email Message has been updated';
$lang['msg_delete_status'] = 'Unless you know what you’re doing, it isn’t recommended to delete status, please confirm action before deleting.';
$lang['msg_status_added'] = 'Status has been successfully added.';
$lang['msg_uniquestatus'] = 'The %s must have a unique value of each status name';
$lang['msg_status_delete'] = 'Status has been deleted';
$lang['msg_user_updated'] = 'User has been successfully updated.';
$lang['msg_user_added'] = 'User has been successfully added.';
$lang['msg_user_deleted'] = 'User has been deleted';
$lang['msg_user_activated'] = 'User has been successfully activated.';
$lang['msg_user_deactivated'] = 'User has been successfully deactivated.';
$lang['msg_user_passchanged'] = 'Password Changed';
$lang['msg_ugroup_updated'] = 'Group has been successfully updated.';
$lang['msg_ugroup_added'] = 'Group has been successfully added.';
$lang['msg_ugroup_deleted'] = 'User Group has been deleted';
$lang['msg_department_updated'] = 'Department has been successfully updated.';
$lang['msg_department_added'] = 'Department has been successfully added.';
$lang['msg_department_deleted'] = 'Department has been deleted';
$lang['msg_branch_updated'] = 'Branch has been successfully updated.';
$lang['msg_branch_added'] = 'Branch has been successfully added.';
$lang['msg_branch_deleted'] = 'Branch has been deleted';
$lang['msg_supplier_added'] = 'Supplier has been successfully added.';
$lang['msg_supplier_updated'] = 'Supplier has been successfully updated.';
$lang['msg_supplier_deleted'] = 'Supplier has been deleted';
$lang['msg_product_added'] = 'Product has been successfully added.';
$lang['msg_product_deleted'] = 'Product has been deleted';
$lang['msg_product_updated'] = 'Product has been successfully updated.';
$lang['msg_productcat_added'] = 'Product Category has been successfully added.';
$lang['msg_productcat_deleted'] = 'Category has been deleted';
$lang['msg_productcat_updated'] = 'Product Category has been successfully updated.';
$lang['msg_reqcat_added'] = 'Request Category has been successfully added.';
$lang['msg_reqcat_updated'] = 'Request Category has been successfully updated.';
$lang['msg_reqcat_deleted'] = 'Request Category has been deleted';
$lang['msg_profile_updated'] = 'Profile has been successfully updated';
$lang['msg_pass_not_match'] = 'Password not match';
$lang['msg_failed_upload'] = 'Failed to upload file, please contact the system programmer';
$lang['msg_approve_po'] = 'Are you sure you want to approve this Purchase Order?';
$lang['msg_budget_approve_request'] = 'Are you sure you want to approve this request? <br /> A total amount of %s and above shall be subject to Board approval.';
$lang['msg_item_expenditure'] = 'Each item must have expenditure. Please click view items to set.';
$lang['msg_budget_approved'] = 'Budget Approved, Processing request...';
$lang['msg_canvass_item_added'] = 'Canvassed Item has been successfully added.';
$lang['msg_error_adding_data'] = 'Error adding data, Please contact the programmer';
$lang['msg_assign_purchasing'] = 'Please make sure you have reviewed the request properly. Do you want to assign it to purchasing department?';
$lang['msg_forwarded_purchasing'] = 'Request has been forwarded to Admin for review';
$lang['msg_property_updated'] = 'Property has been updated';
$lang['msg_status_error'] = '%s Status %s not found';
$lang['msg_error_create_dir'] = 'Error creating directory. Please make a temp directory manually at the root of this application';
$lang['msg_db_updated'] = 'Database has been successfully updated';

// Datatable heading
$lang['dt_heading_po_num'] = 'P.O. #';
$lang['dt_heading_pr_num'] = 'P.R. #';
$lang['dt_heading_request_type'] = 'Type of Request';
$lang['dt_heading_supplier'] = 'Supplier';
$lang['dt_heading_status'] = 'Status';
$lang['dt_heading_auditor'] = 'Auditor';
$lang['dt_heading_auditor_remarks'] = 'Auditor Remarks';
$lang['dt_heading_action'] = 'Action';
$lang['dt_heading_item_name'] = 'Item Name';
$lang['dt_heading_item_description'] = 'Description';
$lang['dt_heading_quantity'] = 'Quantity';
$lang['dt_heading_unit'] = 'Unit';
$lang['dt_heading_price'] = 'Unit Price';
$lang['dt_heading_amount'] = 'Amount';
$lang['dt_heading_category'] = 'Category';
$lang['dt_heading_expenditure'] = 'Expenditure';
$lang['dt_heading_totalprice'] = 'Total Price';
$lang['dt_heading_attachment'] = 'Attachment';
$lang['dt_heading_eta'] = 'ETA';
$lang['dt_heading_datedelivered'] = 'Date Delivered';
$lang['dt_heading_dateupdated'] = 'Date Updated';
$lang['dt_heading_filename'] = 'Filename';
$lang['dt_heading_followupdate'] = 'Follow-up Date';
$lang['dt_heading_user'] = 'User';
$lang['dt_heading_department'] = 'Department';
$lang['dt_heading_branch'] = 'Branch';
$lang['dt_heading_etd'] = 'ETD';
$lang['dt_heading_assigned_to'] = 'Assigned To';
$lang['dt_heading_officers_note'] = 'Officers Note';
$lang['dt_heading_initiator_note'] = 'Requisitioner Note';
$lang['dt_heading_board_note'] = 'Board Note';
$lang['dt_heading_certified_by'] = 'Certified By';
$lang['dt_heading_date_certified'] = 'Date Certified';
$lang['dt_total_label'] = 'Total';
$lang['dt_date_requested'] = 'Date Requested';
$lang['dt_date_needed'] = 'Date Needed';
$lang['dt_purpose'] = 'Purpose';
$lang['dt_purch_remarks'] = 'Purchasing Remarks';
$lang['dt_purch_note'] = 'Purchasing Note';
$lang['dt_items'] = 'Items';
$lang['dt_status'] = 'Status';
$lang['dt_action'] = 'Action';
$lang['dt_status_name'] = 'Status Name';
$lang['dt_status_num'] = 'Status #';
$lang['dt_status_txt'] = 'Status text';
$lang['dt_status_type'] = 'Status type';
$lang['dt_fname'] = 'First Name';
$lang['dt_lname'] = 'Last Name';
$lang['dt_name'] = 'Name';
$lang['dt_email'] = 'Email';
$lang['dt_role'] = 'Role';
$lang['dt_tel_num'] = 'Tel. Number';
$lang['dt_mobile_num'] = 'Mobile Number';
$lang['dt_fax'] = 'Fax';
$lang['dt_address'] = 'Address';
$lang['dt_title'] = 'Title';
$lang['dt_heading_note'] = 'Note';
$lang['dt_supplier1'] = 'Supplier 1';
$lang['dt_supplier2'] = 'Supplier 2';
$lang['dt_supplier3'] = 'Supplier 3';
$lang['dt_supplier4'] = 'Supplier 4';

// Bootbox modal
$lang['modal_req_items'] = 'Request Items';
$lang['modal_attachment'] = 'Attachment';
$lang['modal_total_supplier'] = 'Total Per Supplier';
$lang['modal_return_request'] = 'Return Request';
$lang['message_label'] = 'Message';
$lang['canvasser_label'] = 'Canvasser';
$lang['modal_assign_canvasser'] = 'Approve and Assign to canvasser';
$lang['modal_return_to_canvasser'] = 'Return to Canvasser';
$lang['modal_deny_req'] ='Deny request';
$lang['label_reason'] = 'Reason';
$lang['modal_items_marked_done'] = 'These items will be marked as done';
$lang['modal_set_expenditure'] = 'Set Expenditure';
$lang['select_option'] = 'Select Option';
$lang['opt_capex'] = 'Capital Expenditure';
$lang['opt_opex'] = 'Operating Expenditure';
$lang['modal_forward_to_budget'] = 'Forward to Budget Department';
$lang['budget_dept_label'] = 'Budget Department';
$lang['modal_reason_response'] = 'Reason and Response window';
$lang['your_response_label'] = 'Your Response';
$lang['modal_delete_item'] = 'Delete Item';
$lang['modal_select_product_help'] = 'If the requested item is not listed, just simply type the word and click or enter to create and add such name on the list';
$lang['modal_add_attachment'] = 'Add Attachment';
$lang['modal_forward_purchasing'] = 'Forward to Purchasing Department Admin';

$lang['modal_title_denied_items'] = 'Denied Items';
$lang['modal_approve_file_purchasing'] = 'Approve and File Request to Purchasing Department';
$lang['modal_title_edit_emails'] = 'Edit Emails';
$lang['modal_lbl_subject'] = 'Subject';
$lang['modal_shortcode_info'] = 'Please note that some shortcode will work only in some specific process. Example is using the [po_number] shortcode in the new request process.';
$lang['modal_edit_status'] = 'Edit Status';
$lang['modal_edit_user'] = 'Edit User';
$lang['modal_change_password'] = 'Change User Password';
$lang['modal_edit_ugroup'] = 'Edit User Group';
$lang['modal_add_ugroup'] = 'Edit User Group';
$lang['modal_edit_department'] = 'Edit Department';
$lang['modal_edit_branch'] = 'Edit Branch';
$lang['modal_add_supplier'] = 'Add Supplier';
$lang['modal_edit_supplier'] = 'Edit Supplier';
$lang['modal_add_product'] = 'Add Product';
$lang['modal_edit_product'] = 'Edit Product';
$lang['modal_add_productcat'] = 'Add Product Category';
$lang['modal_edit_productcat'] = 'Edit Product Category';
$lang['modal_add_reqcat'] = 'Add Request Category';
$lang['modal_edit_reqcat'] = 'Edit Request Category';
$lang['modal_return_purchasing'] = 'Return to Purchasing Department';
$lang['modal_edit_req'] = 'Edit Request';
$lang['modal_prop_received'] = 'Received';
$lang['modal_prop_item'] = 'Property Items';

/* == ============================== PDFs ================================== ==*/
// PO
$lang['pdf_heading_purchasing_dept'] = 'Purchasing Department';
$lang['pdf_po_form_title'] = 'Purchasing Order Form';
$lang['pdf_po_num'] = 'P.O. No.';
$lang['pdf_pr_num'] = 'P.R. No.';
$lang['pdf_supplier_label'] = 'Supplier';
$lang['pdf_date_issue_label'] = 'Date';
$lang['pdf_products_heading'] = 'PRODUCT / SERVICE SPECIFICATIONS';
$lang['pdf_qty_heading'] = 'QUANTITY';
$lang['pdf_price_heading'] = 'UNIT PRICE';
$lang['pdf_amount_heading'] = 'AMOUNT';
$lang['pdf_total_label'] = 'Total';
$lang['pdf_note_label'] = 'NOTE';
$lang['pdf_auditor_label'] = 'Auditor';
$lang['pdf_po_date_label'] = 'Date';
$lang['pdf_prepared_by_label'] = 'Prepared By';

// print request
$lang['pdf_recieved'] = 'RECEIVED';
$lang['pdf_time_label'] = 'Time';
$lang['pdf_by_label'] = 'By';
$lang['pdf_purch_req_slip'] = 'Purchase Requisition Slip';
$lang['pdf_purch_use_only'] = '(For Purchasing Department use only)';
$lang['pdf_quotations_label'] = 'Quotations';
$lang['pdf_name_supplier_unit'] = 'Name of Supplier and Price Per Unit';
$lang['pdf_requested_by'] = 'Requested By';
$lang['pdf_sign_over_printed'] = 'Signature Over Printed Name';
$lang['pdf_dept_branch'] = 'Department and Branch';
$lang['pdf_recommending_approval'] = 'Recommending Approval';
$lang['pdf_with_budget'] = 'With Budget';
$lang['pdf_budget_certified_by'] = 'Budget Certified By';
$lang['pdf_head_budget_dept'] = 'Head, Budget Department';
$lang['pdf_canvassed_by'] = 'Canvassed By';
$lang['pdf_approve_purchased_by'] = 'Approved or Purchased By';
$lang['pdf_head_purchasing_dept'] = 'Head, Purchasing Department';
$lang['pdf_canvass_title'] = 'Canvassed items for %s';

/* Left Sidebar*/
$lang['lbl_welcome'] = 'Welcome';