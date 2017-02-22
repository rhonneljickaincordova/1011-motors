<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Authentication extends CI_Controller {

	/**
	 * Shows the sign in form
	 */
	public function sign_in()
	{
		$this->load->view('authentication/sign_in');
	}

	/**
	 * Signs out the current user
	 */
	public function sign_out()
	{
		$this->session->sess_destroy();

		redirect('sign_in');
	}

	/**
	 * Verify the user's credentials
	 */
	public function verify()
	{
		$this->load->model(array('employee', 'position'));

		$this->employee->set_username($this->input->post('username'));
		$this->employee->set_password(md5($this->input->post('password')));

		if ($this->employee->is_verified())
		{
			$employee = $this->wildfire->find('employee', array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			));

			$this->session->set_userdata('employee_id', $employee->get_id());
			$this->session->set_userdata('name', $employee->get_name());
			$this->session->set_userdata('type', $employee->get_position_id()->get_description());

			if ($this->input->get('current_url'))
			{
				redirect($this->input->get('current_url'));				
			}

			redirect('dashboard');
		}
		else
		{
			$this->session->set_flashdata('notification', 'Oops! Wrong username or password!');
			$this->session->set_flashdata('alert', 'danger');
		}

		redirect('sign_in');
	}

}