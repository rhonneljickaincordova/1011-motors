<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employees Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Employees extends CI_Controller {

	/**
	 * Load the specified models
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'employee',
			'position'
		));
	}

	/**
	 * Show the form for creating a new employee
	 */
	public function create()
	{
		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$this->employee->set_first_name($this->input->post('first_name'));
			$this->employee->set_last_name($this->input->post('last_name'));
			$this->employee->set_username($this->input->post('username'));
			
			if ($this->input->post('password') == $this->input->post('confirm_password'))
			{
				$this->employee->set_password(md5($this->input->post('password')));
			}
			else
			{
				$this->session->set_flashdata('notification', 'The passwords you entered did not match!');
				$this->session->set_flashdata('alert', 'danger');
				
				redirect('employees/create');
			}


			$position = $this->wildfire->find('position', $this->input->post('position_id'));
			$this->employee->set_position_id($position);

			$this->employee->set_datetime_created('now');

			$this->employee->save();

			$this->session->set_flashdata('notification', 'The employee has been created successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('employees');
		}

		$data = array();
		$data['positions'] = $this->wildfire->get_all('position')->as_dropdown('description');

		$this->load->view('employees/create', $data);
	}

	/**
	 * Delete the specified employee from storage
	 * 
	 * @param  int $id
	 */
	public function delete($id)
	{
		if ( ! isset($id))
		{
			redirect('employees');
		}

		$this->wildfire->delete('employee', $id);

		$this->session->set_flashdata('notification', 'The employee has been deleted successfully!');
		$this->session->set_flashdata('alert', 'success');

		redirect('employees');
	}

	/**
	 * Show the form for editing the specified employee
	 * 
	 * @param  int $id
	 */
	public function edit($id)
	{
		if ( ! isset($id))
		{
			redirect('employees');
		}

		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$employee = $this->wildfire->find('employee', $id);

			$employee->set_first_name($this->input->post('first_name'));
			$employee->set_last_name($this->input->post('last_name'));
			$employee->set_username($this->input->post('username'));
			
			if ($this->input->post('old_password') != NULL && $this->input->post('new_password') != NULL && $this->input->post('confirm_password') != NULL)
			{
				if (md5($this->input->post('old_password')) != $employee->get_password() || $this->input->post('new_password') != $this->input->post('confirm_password'))
				{
					$this->session->set_flashdata('notification', 'The passwords you entered did not match!');
					$this->session->set_flashdata('alert', 'danger');
					
					redirect('employees/edit/' . $id);
				}
				else
				{
					$employee->set_password(md5($this->input->post('new_password')));
				}
			}


			$position = $this->wildfire->find('position', $this->input->post('position_id'));
			$employee->set_position_id($position);

			$employee->set_datetime_updated('now');

			$employee->save();

			$this->session->set_flashdata('notification', 'The employee has been updated successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('employees');
		}

		$data['employee'] = $this->wildfire->find('employee', $id);
		$data['positions'] = $this->wildfire->get_all('position')->as_dropdown('description');

		$this->load->view('employees/edit', $data);
	}

	/**
	 * Display a listing of employees
	 */
	public function index()
	{
		$this->load->library('pagination');

		include APPPATH . 'config/pagination.php';

		$delimiters = array();
		$delimiters['keyword'] = $this->input->get('keyword');

		$config['suffix']      = '?keyword=' . $delimiters['keyword'];
		$config['total_rows']  = $this->wildfire->get_all('employee', $delimiters)->total_rows();

		$this->pagination->initialize($config);

		$delimiters['page']     = $this->pagination->offset;
		$delimiters['per_page'] = $config['per_page'];

		$data['employees'] = $this->wildfire->get_all('employee', $delimiters)->result();
		$data['links'] = $this->pagination->create_links();

		$this->load->view('employees/index', $data);
	}

	/**
	 * Display the specified employee
	 * 
	 * @param  int $id
	 */
	public function show($id)
	{
		if ( ! isset($id))
		{
			redirect('employees');
		}
		
		$data['employee'] = $this->wildfire->find('employee', $id);

		$this->load->view('employees/show', $data);
	}

	/**
	 * Validate the input retrieved from the view
	 */
	private function _validate_input()
	{
		$this->load->library('form_validation');

		$columns = array(
			'name' => 'name',
			'username' => 'username',
			'position_id' => 'position ID'
		);

		foreach ($columns as $column => $label)
		{
			$rules = 'required';

			if (strpos($column, 'email') !== FALSE)
			{
				$rules .= '|valid_email';
			}

			$this->form_validation->set_rules($column, $label, $rules);
		}
	}

}