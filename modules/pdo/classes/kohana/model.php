<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Model base class. All models should extend this class.
 *
 * @package    pdo
 * @author     Lillem4n
 * @url        http://kohana.lillem4n.se
 */
abstract class Kohana_Model {

	// Database instance
	public $pdo = 'default';

	/**
	 * Loads the database.
	 *
	 *     $model = new Foo_Model($db);
	 *
	 * @param   mixed  Database instance object or string
	 * @return  void
	 */
	public function __construct($instance_name = NULL)
	{
		if ($instance_name !== NULL)
		{
			// Set the database instance name
			$this->pdo = $instance_name;
		}

		if (is_string($this->pdo))
		{
			// Load the database
			$this->pdo = Kohana_pdo::instance($this->pdo);
		}
	}

} // End Model
