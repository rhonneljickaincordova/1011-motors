<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Position Model Class
 *
 * @package  CodeIgniter
 * @category Model
 */
class Position extends CI_Model {

	protected $_id;
	protected $_description;
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
	 * Get description
	 *
	 * @return varchar(20)
	 */
	public function get_description()
	{
		return $this->_description;
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
			'description' => $this->get_description(),
			'datetime_created' => $this->get_datetime_created()->format('Y-m-d H:i:s'),
			'datetime_updated' => $this->get_datetime_updated()->format('Y-m-d H:i:s')
		);

		if ($this->_id > 0)
		{
			$this->db->where('id', $this->_id);

			if ($this->db->get('position')->num_rows())
			{
				if ($this->db->update('position', $data, array('id' => $this->_id)))
				{
					return TRUE;
				}
			}
			else
			{
				if ($this->db->insert('position', $data))
				{	
					return TRUE;
				}
			}
		}
		else
		{
			if ($this->db->insert('position', $data))
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
	 * Set description
	 *
	 * @param varchar(20) $description
	 */
	public function set_description($description)
	{
		$this->_description = $description;

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