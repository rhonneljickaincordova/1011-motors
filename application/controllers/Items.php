<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Items Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Items extends CI_Controller {

	/**
	 * Load the specified models
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'item',
			'employee',
			'position'
		));
	}

	/**
	 * Show the form for creating a new item
	 */
	public function create()
	{
		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$this->item->set_employee_id($employee);

			$this->item->set_description($this->input->post('description'));
			$this->item->set_datetime_created('now');

			$this->item->save();

			$this->session->set_flashdata('notification', 'The item has been created successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('items');
		}

		$data = array();
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');

		$this->load->view('items/create', $data);
	}

	/**
	 * Delete the specified item from storage
	 * 
	 * @param  int $id
	 */
	public function delete($id)
	{
		if ( ! isset($id))
		{
			redirect('items');
		}

		$this->wildfire->delete('item', $id);

		$this->session->set_flashdata('notification', 'The item has been deleted successfully!');
		$this->session->set_flashdata('alert', 'success');

		redirect('items');
	}

	/**
	 * Show the form for editing the specified item
	 * 
	 * @param  int $id
	 */
	public function edit($id)
	{
		if ( ! isset($id))
		{
			redirect('items');
		}

		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$item = $this->wildfire->find('item', $id);

			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$item->set_employee_id($employee);

			$item->set_description($this->input->post('description'));
			$item->set_datetime_updated('now');

			$item->save();

			$this->session->set_flashdata('notification', 'The item has been updated successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('items');
		}

		$data['item'] = $this->wildfire->find('item', $id);
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');

		$this->load->view('items/edit', $data);
	}

	/**
	 * Display a listing of items
	 */
	public function index()
	{
		$this->load->library('pagination');

		include APPPATH . 'config/pagination.php';

		$delimiters = array();
		$delimiters['keyword'] = $this->input->get('keyword');

		$config['suffix']      = '?keyword=' . $delimiters['keyword'];
		$config['total_rows']  = $this->wildfire->get_all('item', $delimiters)->total_rows();

		$this->pagination->initialize($config);

		$delimiters['page']     = $this->pagination->offset;
		$delimiters['per_page'] = $config['per_page'];

		$data['items'] = $this->wildfire->get_all('item', $delimiters)->result();
		$data['links'] = $this->pagination->create_links();

		$this->load->view('items/index', $data);
	}

	/**
	 * Display the specified item
	 * 
	 * @param  int $id
	 */
	public function show($id)
	{
		if ( ! isset($id))
		{
			redirect('items');
		}
		
		$data['item'] = $this->wildfire->find('item', $id);

		$this->load->view('items/show', $data);
	}

	/**
	 * Validate the input retrieved from the view
	 */
	private function _validate_input()
	{
		$this->load->library('form_validation');

		$columns = array(
			'description' => 'description'
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