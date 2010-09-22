<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_People extends Admincontroller {

	public function __construct()
	{
		parent::__construct();
		// Set the name of the template to use
		$this->xslt_stylesheet = 'admin/people';
		xml::to_XML(array('admin_page' => 'People'), $this->xml_meta);
	}

	public function action_index()
	{
	}

	public function action_add_person()
	{
		$this->xml_content_people = $this->xml_content->appendChild($this->dom->createElement('people'));
		xml::to_XML(People::get_fields(), $this->xml_content_people, 'field', array('id'));

		if (count($_POST))
		{
			$post = new Validate($_POST);
			$post->filter(TRUE, 'trim');

			foreach ($_POST as $field => $content)
			{
				$post->label($field, $field);
			}

			if ($post->check())
			{
				if (strlen(implode('',$_POST)) != 0)
				// All fields cannot be empty
				{
					$new_person_id = People::add_person($post->as_array());
					$this->add_message('Person added, id: '.$new_person_id);
				}
			}
			else
			{
				$this->add_error('Fix errors and try again');
				$this->add_form_errors($post->errors());

				$this->set_formdata(array_intersect_key($post->as_array(), $_POST));
			}
		}

	}

}
