<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Positions Controller Class
 *
 * @package  CodeIgniter
 * @category Controller
 */
class Positions extends CI_Controller {

	/**
	 * Load the specified models
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'position'
		));
	}

	/**
	 * Show the form for creating a new position
	 */
	public function create()
	{
		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$this->position->set_description($this->input->post('description'));
			$this->position->set_datetime_created('now');

			$this->position->save();

			$this->session->set_flashdata('notification', 'The position has been created successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('positions');
		}

		$data = array();

		$this->load->view('positions/create', $data);
	}

	/**
	 * Delete the specified position from storage
	 * 
	 * @param  int $id
	 */
	public function delete($id)
	{
		if ( ! isset($id))
		{
			redirect('positions');
		}

		$this->wildfire->delete('position', $id);

		$this->session->set_flashdata('notification', 'The position has been deleted successfully!');
		$this->session->set_flashdata('alert', 'success');

		redirect('positions');
	}

	/**
	 * Show the form for editing the specified position
	 * 
	 * @param  int $id
	 */
	public function edit($id)
	{
		if ( ! isset($id))
		{
			redirect('positions');
		}

		$this->_validate_input();

		if ($this->form_validation->run())
		{
			$position = $this->wildfire->find('position', $id);

			$position->set_description($this->input->post('description'));
			$position->set_datetime_updated('now');

			$position->save();

			$this->session->set_flashdata('notification', 'The position has been updated successfully!');
			$this->session->set_flashdata('alert', 'success');

			redirect('positions');
		}

		$data['position'] = $this->wildfire->find('position', $id);

		$this->load->view('positions/edit', $data);
	}

	/**
	 * Display a listing of positions
	 */
	public function index()
	{
		$this->load->library('pagination');

		include APPPATH . 'config/pagination.php';

		$delimiters = array();
		$delimiters['keyword'] = $this->input->get('keyword');

		$config['suffix']      = '?keyword=' . $delimiters['keyword'];
		$config['total_rows']  = $this->wildfire->get_all('position', $delimiters)->total_rows();

		$this->pagination->initialize($config);

		$delimiters['page']     = $this->pagination->offset;
		$delimiters['per_page'] = $config['per_page'];

		$data['positions'] = $this->wildfire->get_all('position', $delimiters)->result();
		$data['links'] = $this->pagination->create_links();

		$this->load->view('positions/index', $data);
	}

	/**
	 * Display the specified position
	 * 
	 * @param  int $id
	 */
	public function show($id)
	{
		if ( ! isset($id))
		{
			redirect('positions');
		}
		
		$data['position'] = $this->wildfire->find('position', $id);

		$this->load->view('positions/show', $data);
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