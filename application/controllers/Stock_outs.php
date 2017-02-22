<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stock outs Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Stock_outs extends CI_Controller {

	/**
	 * Load the specified models
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'stock_out',
			'employee',
			'position',
			'item'
		));
	}

	/**
	 * Show the form for creating a new stock_out
	 */
	public function create()
	{
		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$this->stock_out->set_employee_id($employee);

			$item = $this->wildfire->find('item', $this->input->post('item_id'));
			$this->stock_out->set_item_id($item);

			$this->stock_out->set_quantity($this->input->post('quantity'));
			$this->stock_out->set_datetime_created('now');

			$this->stock_out->save();

			$this->session->set_flashdata('notification', 'The stock_out has been created successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('stock_outs');
		}

		$data = array();
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');
		$data['items'] = $this->wildfire->get_all('item')->as_dropdown('description');

		$this->load->view('stock_outs/create', $data);
	}

	/**
	 * Delete the specified stock_out from storage
	 * 
	 * @param  int $id
	 */
	public function delete($id)
	{
		if ( ! isset($id))
		{
			redirect('stock_outs');
		}

		$this->wildfire->delete('stock_out', $id);

		$this->session->set_flashdata('notification', 'The stock_out has been deleted successfully!');
		$this->session->set_flashdata('alert', 'success');

		redirect('stock_outs');
	}

	/**
	 * Show the form for editing the specified stock_out
	 * 
	 * @param  int $id
	 */
	public function edit($id)
	{
		if ( ! isset($id))
		{
			redirect('stock_outs');
		}

		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$stock_out = $this->wildfire->find('stock_out', $id);

			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$stock_out->set_employee_id($employee);

			$item = $this->wildfire->find('item', $this->input->post('item_id'));
			$stock_out->set_item_id($item);

			$stock_out->set_quantity($this->input->post('quantity'));
			$stock_out->set_datetime_updated('now');

			$stock_out->save();

			$this->session->set_flashdata('notification', 'The stock_out has been updated successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('stock_outs');
		}

		$data['stock_out'] = $this->wildfire->find('stock_out', $id);
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');
		$data['items'] = $this->wildfire->get_all('item')->as_dropdown('description');

		$this->load->view('stock_outs/edit', $data);
	}

	/**
	 * Display a listing of stock_outs
	 */
	public function index()
	{
		$this->load->library('pagination');

		include APPPATH . 'config/pagination.php';

		$delimiters = array();
		$delimiters['keyword'] = $this->input->get('keyword');

		$config['suffix']      = '?keyword=' . $delimiters['keyword'];
		$config['total_rows']  = $this->wildfire->get_all('stock_out', $delimiters)->total_rows();

		$this->pagination->initialize($config);

		$delimiters['page']     = $this->pagination->offset;
		$delimiters['per_page'] = $config['per_page'];

		$data['stock_outs'] = $this->wildfire->get_all('stock_out', $delimiters)->result();
		$data['links'] = $this->pagination->create_links();

		$this->load->view('stock_outs/index', $data);
	}

	/**
	 * Display the specified stock_out
	 * 
	 * @param  int $id
	 */
	public function show($id)
	{
		if ( ! isset($id))
		{
			redirect('stock_outs');
		}
		
		$data['stock_out'] = $this->wildfire->find('stock_out', $id);

		$this->load->view('stock_outs/show', $data);
	}

	/**
	 * Validate the input retrieved from the view
	 */
	private function _validate_input()
	{
		$this->load->library('form_validation');

		$columns = array(
			'item_id' => 'item ID',
			'quantity' => 'quantity'
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