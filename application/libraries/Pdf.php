<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pdf {

	function __construct()
	{
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}
	function load($params=NULL)
	{
		// php version 5.6 compatibility
		if(version_compare(PHP_VERSION, '7.0.0', '<'))
		{
			include_once FCPATH.'/vendor/paragonie/random_compat/lib/random.php';
		}

		include_once FCPATH.'/vendor/autoload.php';
		if ($params == NULL)
		{
			$params = array(
				'mode' => 'utf-8',
				'format' => 'A4',
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 10,
				'margin_bottom' => 10,
				'margin_header' => 6,
				'margin_footer' => 3,
			);
		}
		return new \Mpdf\Mpdf($params);
	}
}
