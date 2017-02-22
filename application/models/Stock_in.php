<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stock In Model Class
 *
 * @package  CodeIgniter
 * @category Model
 */
class Stock_in extends CI_Model {

	protected $_id;
	protected $_employee_id;
	protected $_item_id;
	protected $_quantity;
	protected $_price;
	protected $_datetime_created;
	protected $_datetime_updated;

	/**
	 * Get id
	 *
	 * @return int(10)
	 */
	public function get_id()
	{
		return $this->_id;
	}

	/**
	 * Get employee_id
	 *
	 * @return \Employee
	 */
	public function get_employee_id()
	{
		return $this->_employee_id;
	}

	/**
	 * Get item_id
	 *
	 * @return \Item
	 */
	public function get_item_id()
	{
		return $this->_item_id;
	}

	/**
	 * Get quantity
	 *
	 * @return varchar(10)
	 */
	public function get_quantity()
	{
		return $this->_quantity;
	}

	/**
	 * Get price
	 *
	 * @return decimal(10,0)
	 */
	public function get_price()
	{
		return $this->_price;
	}

	/**
	 * Get datetime_created
	 *
	 * @return varchar()
	 */
	public function get_datetime_created()
	{
		if (is_a($this->_datetime_created, 'DateTime'))
		{
			return $this->_datetime_created;
		}

		return new DateTime($this->_datetime_created);
	}

	/**
	 * Get datetime_updated
	 *
	 * @return varchar()
	 */
	public function get_datetime_updated()
	{
		if (is_a($this->_datetime_updated, 'DateTime'))
		{
			return $this->_datetime_updated;
		}

		return new DateTime($this->_datetime_updated);
	}

	/**
	 * Save the data to storage
	 * 
	 * @return boolean
	 */
	public function save()
	{
		$data = array(
			'id' => $this->get_id(),
			'employee_id' => $this->get_employee_id()->get_id(),
			'item_id' => $this->get_item_id()->get_id(),
			'quantity' => $this->get_quantity(),
			'price' => $this->get_price(),
			'datetime_created' => $this->get_datetime_created()->format('Y-m-d H:i:s'),
			'datetime_updated' => $this->get_datetime_updated()->format('Y-m-d H:i:s')
		);

		if ($this->_id > 0)
		{
			$this->db->where('id', $this->_id);

			if ($this->db->get('stock_in')->num_rows())
			{
				if ($this->db->update('stock_in', $data, array('id' => $this->_id)))
				{
					return TRUE;
				}
			}
			else
			{
				if ($this->db->insert('stock_in', $data))
				{	
					return TRUE;
				}
			}
		}
		else
		{
			if ($this->db->insert('stock_in', $data))
			{
				$this->_id = $this->db->insert_id();
				
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Set id
	 *
	 * @param int(10) $id
	 */
	public function set_id($id)
	{
		$this->_id = $id;

		return $this;
	}

	/**
	 * Set employee_id
	 *
	 * @param \Employee $employee_id
	 */
	public function set_employee_id(\Employee $employee_id)
	{
		$this->_employee_id = $employee_id;

		return $this;
	}

	/**
	 * Set item_id
	 *
	 * @param \Item $item_id
	 */
	public function set_item_id(\Item $item_id)
	{
		$this->_item_id = $item_id;

		return $this;
	}

	/**
	 * Set quantity
	 *
	 * @param varchar(10) $quantity
	 */
	public function set_quantity($quantity)
	{
		$this->_quantity = $quantity;

		return $this;
	}

	/**
	 * Set price
	 *
	 * @param decimal(10,0) $price
	 */
	public function set_price($price)
	{
		$this->_price = $price;

		return $this;
	}

	/**
	 * Set datetime_created
	 *
	 * @param varchar() $datetime_created
	 */
	public function set_datetime_created($datetime_created)
	{
		$this->_datetime_created = new DateTime($datetime_created);

		return $this;
	}

	/**
	 * Set datetime_updated
	 *
	 * @param varchar() $datetime_updated
	 */
	public function set_datetime_updated($datetime_updated = NULL)
	{
		$this->_datetime_updated = new DateTime($datetime_updated);

		return $this;
	}

}