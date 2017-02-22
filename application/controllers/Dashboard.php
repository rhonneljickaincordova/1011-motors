<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Dashboard extends CI_Controller {

	/**
	 * Display a listing of employees
	 */
	public function index()
	{
		$this->load->view('dashboard/index');
	}

}