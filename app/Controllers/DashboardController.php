<?php 
	namespace App\Controllers;  

	class DashboardController extends BaseController {
        /////////////////////////////////////////////////////
		// Define the Globle veriable within Controller class
		protected $title = 'Dashboard';
		protected $data = array();

		/////////////////////////////////////////////////////
		public function __construct() {
			$linkTags = array(
				'css' => array(
					'href' => 'public/css/home.css',
					'rel' => 'stylesheet',
					'type' => 'text/css'
				)
			);

			$this->data = array(
				'title' => $this->title,
				'linkTags' => $linkTags
			);
		}

		public function index()
		{
			helper(['form']);

			$session = session();

			return view('dashboard/home', $this->data);
		} 
	}
?>