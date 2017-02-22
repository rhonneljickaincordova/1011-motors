<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sales Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Sales extends CI_Controller {

	/**
	 * Load the specified models
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'sale',
			'employee',
			'position',
			'item'
		));
	}

	/**
	 * Show the form for creating a new sale
	 */
	public function create()
	{
		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$this->sale->set_employee_id($employee);

			$this->sale->set_customer($this->input->post('customer'));
			$this->sale->set_quantity($this->input->post('quantity'));

			$item = $this->wildfire->find('item', $this->input->post('item_id'));
			$this->sale->set_item_id($item);

			$this->sale->set_price($this->input->post('price'));
			$this->sale->set_remarks($this->input->post('remarks'));
			$this->sale->set_datetime_created('now');

			$this->sale->save();

			$this->session->set_flashdata('notification', 'The sale has been created successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('sales');
		}

		$data = array();
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');
		$data['items'] = $this->wildfire->get_all('item')->as_dropdown('description');

		$this->load->view('sales/create', $data);
	}

	/**
	 * Delete the specified sale from storage
	 * 
	 * @param  int $id
	 */
	public function delete($id)
	{
		if ( ! isset($id))
		{
			redirect('sales');
		}

		$this->wildfire->delete('sale', $id);

		$this->session->set_flashdata('notification', 'The sale has been deleted successfully!');
		$this->session->set_flashdata('alert', 'success');

		redirect('sales');
	}

	/**
	 * Show the form for editing the specified sale
	 * 
	 * @param  int $id
	 */
	public function edit($id)
	{
		if ( ! isset($id))
		{
			redirect('sales');
		}

		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$sale = $this->wildfire->find('sale', $id);

			$employee = $this->wildfire->find('employee', $this->session->userdata('employee_id'));
			$sale->set_employee_id($employee);

			$sale->set_customer($this->input->post('customer'));
			$sale->set_quantity($this->input->post('quantity'));

			$item = $this->wildfire->find('item', $this->input->post('item_id'));
			$sale->set_item_id($item);

			$sale->set_price($this->input->post('price'));
			$sale->set_remarks($this->input->post('remarks'));
			$sale->set_datetime_updated('now');

			$sale->save();

			$this->session->set_flashdata('notification', 'The sale has been updated successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('sales');
		}

		$data['sale'] = $this->wildfire->find('sale', $id);
		$data['employees'] = $this->wildfire->get_all('employee')->as_dropdown('name');
		$data['items'] = $this->wildfire->get_all('item')->as_dropdown('description');

		$this->load->view('sales/edit', $data);
	}

	/**
	 * Display a listing of sales
	 */
	public function index()
	{
		$this->load->library('pagination');

		include APPPATH . 'config/pagination.php';

		$delimiters = array();
		$delimiters['keyword'] = $this->input->get('keyword');

		$config['suffix']      = '?keyword=' . $delimiters['keyword'];
		$config['total_rows']  = $this->wildfire->get_all('sale', $delimiters)->total_rows();

		$this->pagination->initialize($config);

		$delimiters['page']     = $this->pagination->offset;
		$delimiters['per_page'] = $config['per_page'];

		$data['sales'] = $this->wildfire->get_all('sale', $delimiters)->result();
		$data['links'] = $this->pagination->create_links();

		$this->load->view('sales/index', $data);
	}

	/**
	 * Display the specified sale
	 * 
	 * @param  int $id
	 */
	public function show($id)
	{
		if ( ! isset($id))
		{
			redirect('sales');
		}
		
		$data['sale'] = $this->wildfire->find('sale', $id);

		$this->load->view('sales/show', $data);
	}

	/**
	 * Validate the input retrieved from the view
	 */
	private function _validate_input()
	{
		$this->load->library('form_validation');

		$columns = array(
			'customer' => 'customer',
			'quantity' => 'quantity',
			'item_id' => 'item ID',
			'price' => 'price',
			'remarks' => 'remarks'
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