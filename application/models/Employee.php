<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employee Model Class
 *
 * @package  CodeIgniter
 * @category Model
 */
class Employee extends CI_Model {

	protected $_id;
	protected $_first_name;
	protected $_last_name;
	protected $_username;
	protected $_password;
	protected $_position_id;
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
	 * Get first_name
	 *
	 * @return varchar(50)
	 */
	public function get_first_name()
	{
		return $this->_first_name;
	}

	/**
	 * Get last_name
	 *
	 * @return varchar(50)
	 */
	public function get_last_name()
	{
		return $this->_last_name;
	}

	/**
	 * Get username
	 *
	 * @return varchar(50)
	 */
	public function get_username()
	{
		return $this->_username;
	}

	/**
	 * Get password
	 *
	 * @return varchar(50)
	 */
	public function get_password()
	{
		return $this->_password;
	}

	/**
	 * Get position_id
	 *
	 * @return \Position
	 */
	public function get_position_id()
	{
		return $this->_position_id;
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
			'name' => $this->get_name(),
			'username' => $this->get_username(),
			'password' => $this->get_password(),
			'position_id' => $this->get_position_id()->get_id(),
			'datetime_created' => $this->get_datetime_created()->format('Y-m-d H:i:s'),
			'datetime_updated' => $this->get_datetime_updated()->format('Y-m-d H:i:s')
		);

		if ($this->_id > 0)
		{
			$this->db->where('id', $this->_id);

			if ($this->db->get('employee')->num_rows())
			{
				if ($this->db->update('employee', $data, array('id' => $this->_id)))
				{
					return TRUE;
				}
			}
			else
			{
				if ($this->db->insert('employee', $data))
				{	
					return TRUE;
				}
			}
		}
		else
		{
			if ($this->db->insert('employee', $data))
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
	 * Set first_name
	 *
	 * @param varchar(50) $first_name
	 */
	public function set_first_name($first_name)
	{
		$this->_first_name = $first_name;

		return $this;
	}

	/**
	 * Set last_name
	 *
	 * @param varchar(50) $last_name
	 */
	public function set_last_name($last_name)
	{
		$this->_last_name = $last_name;

		return $this;
	}

	/**
	 * Set username
	 *
	 * @param varchar(50) $username
	 */
	public function set_username($username)
	{
		$this->_username = $username;

		return $this;
	}

	/**
	 * Set password
	 *
	 * @param varchar(50) $password
	 */
	public function set_password($password)
	{
		$this->_password = $password;

		return $this;
	}

	/**
	 * Set position_id
	 *
	 * @param \Position $position_id
	 */
	public function set_position_id(\Position $position_id)
	{
		$this->_position_id = $position_id;

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

	/**
	 * Get the first name and last name of the specified account
	 * 
	 * @return string
	 */
	public function get_name()
	{
		return $this->_first_name . ' ' . $this->_last_name;
	}

	/**
	 * Check if the employee is verified
	 * 
	 * @return boolean
	 */
	public function is_verified()
	{
		$this->db->where('username', $this->_username);
		$this->db->where('password', $this->_password);

		return $this->db->get('employee')->num_rows();
	}

}