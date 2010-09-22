<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Database PDO model.
 *
 * @author     Lillem4n
 * @url        http://kohana.lillem4n.se
 */
class Kohana_pdo
{

	/**
	 * Saved instances of this object for later fetching
	 *
	 * @var array of objects
	 */
	public static $instances = array();

	/**
	 * PDO connection
	 *
	 * @var object
	 */
	public $db;

	public function __construct($instance_name = 'default')
	{
		if (!isset(self::$instances[$instance_name]))
		{
			if ($db_settings = Kohana::config('pdo.'.$instance_name))
			{

				$connection_string = Kohana::config('pdo.connection_strings.'.$db_settings['driver']);
				foreach ($db_settings as $key => $value)
				{
					if (!in_array($key, array('username', 'password', 'driver_options')))
						$connection_string = str_replace('{'.$key.'}', $value, $connection_string);
				}

				if (!isset($db_settings['username']))       $db_settings['username']       = NULL;
				if (!isset($db_settings['password']))       $db_settings['password']       = NULL;
				if (!isset($db_settings['driver_options'])) $db_settings['driver_options'] = NULL;

				$this->db = new PDO($connection_string, $db_settings['username'], $db_settings['password'], $db_settings['driver_options']);

			  self::$instances[$instance_name] = $this;

				if (Kohana::$environment == Kohana::DEVELOPMENT)
				{
					$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
			}
			return false;
		}
	}

	public static function instance($instance_name = 'default')
	{
	  if (!isset(self::$instances[$instance_name]))
	  {
	    new Kohana_pdo($instance_name);
	  }
	  if (isset(self::$instances[$instance_name]))
	  {
	    return self::$instances[$instance_name]->db;
	  }
    return false;
	}

}
