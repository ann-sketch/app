<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * XWB Purchasing
 * 
 * @package 	XWB Purchasing
 * @author      Jay-r Simpron
 * @copyright   Copyright (c) 2017, Jay-r Simpron
 */


/**
 * Request Controller
 * 
 * You can override all the parent method here.
 */
class Request extends Xwb_request {

	/**
	 * Run parent construct
	 * 
	 * @return Null
	 */
	public function __construct(){
		parent::__construct();
	}

}
