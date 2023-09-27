<?php 
	namespace App\Controllers;  

	class HomeController extends BaseController {
		public function index() {
			$session = session();
			echo "Hello : ".$session->get('name');
		}
	}
?>