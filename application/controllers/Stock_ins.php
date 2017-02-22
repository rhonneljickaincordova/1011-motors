<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stock ins Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Stock_ins extends CI_Controller {

	/**
	 * Load the specified models
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'stock_in',
			'employee',
			'position',
			'item'
		));
	}

	/**
	 * Show the form for creating a new stock_in
	 */
	public function create()
	{
		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$this->stock_in->set_employee_id($employee);

			$item = $this->wildfire->find('item', $this->input->post('item_id'));
			$this->stock_in->set_item_id($item);

			$this->stock_in->set_quantity($this->input->post('quantity'));
			$this->stock_in->set_price($this->input->post('price'));
			$this->stock_in->set_datetime_created('now');

			$this->stock_in->save();

			$this->session->set_flashdata('notification', 'The stock_in has been created successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('stock_ins');
		}

		$data = array();
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');
		$data['items'] = $this->wildfire->get_all('item')->as_dropdown('description');

		$this->load->view('stock_ins/create', $data);
	}

	/**
	 * Delete the specified stock_in from storage
	 * 
	 * @param  int $id
	 */
	public function delete($id)
	{
		if ( ! isset($id))
		{
			redirect('stock_ins');
		}

		$this->wildfire->delete('stock_in', $id);

		$this->session->set_flashdata('notification', 'The stock_in has been deleted successfully!');
		$this->session->set_flashdata('alert', 'success');

		redirect('stock_ins');
	}

	/**
	 * Show the form for editing the specified stock_in
	 * 
	 * @param  int $id
	 */
	public function edit($id)
	{
		if ( ! isset($id))
		{
			redirect('stock_ins');
		}

		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$stock_in = $this->wildfire->find('stock_in', $id);

			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$stock_in->set_employee_id($employee);

			$item = $this->wildfire->find('item', $this->input->post('item_id'));
			$stock_in->set_item_id($item);

			$stock_in->set_quantity($this->input->post('quantity'));
			$stock_in->set_price($this->input->post('price'));
			$stock_in->set_datetime_updated('now');

			$stock_in->save();

			$this->session->set_flashdata('notification', 'The stock_in has been updated successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('stock_ins');
		}

		$data['stock_in'] = $this->wildfire->find('stock_in', $id);
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');
		$data['items'] = $this->wildfire->get_all('item')->as_dropdown('description');

		$this->load->view('stock_ins/edit', $data);
	}

	/**
	 * Display a listing of stock_ins
	 */
	public function index()
	{
		$this->load->library('pagination');

		include APPPATH . 'config/pagination.php';

		$delimiters = array();
		$delimiters['keyword'] = $this->input->get('keyword');

		$config['suffix']      = '?keyword=' . $delimiters['keyword'];
		$config['total_rows']  = $this->wildfire->get_all('stock_in', $delimiters)->total_rows();

		$this->pagination->initialize($config);

		$delimiters['page']     = $this->pagination->offset;
		$delimiters['per_page'] = $config['per_page'];

		$data['stock_ins'] = $this->wildfire->get_all('stock_in', $delimiters)->result();
		$data['links'] = $this->pagination->create_links();

		$this->load->view('stock_ins/index', $data);
	}

	/**
	 * Display the specified stock_in
	 * 
	 * @param  int $id
	 */
	public function show($id)
	{
		if ( ! isset($id))
		{
			redirect('stock_ins');
		}
		
		$data['stock_in'] = $this->wildfire->find('stock_in', $id);

		$this->load->view('stock_ins/show', $data);
	}

	/**
	 * Validate the input retrieved from the view
	 */
	private function _validate_input()
	{
		$this->load->library('form_validation');

		$columns = array(
			'item_id' => 'item ID',
			'quantity' => 'quantity',
			'price' => 'price'
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