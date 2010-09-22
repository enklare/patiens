<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_People extends Model
{

	public function __construct()
	{
	}

	public static function add_person($data)
	{
		$pdo = Kohana_pdo::instance();

		$pdo->exec('INSERT INTO people_persons (id) VALUES(NULL);');
		$person_id = $pdo->lastInsertId();

		if ($person_id > 0)
		{
			foreach ($data as $field_id => $field_data)
			{
				if (strval(intval($field_data)) === strval($field_data) && $pdo->query('SELECT `table` FROM people_data_fields WHERE id = '.intval($field_id))->fetchColumn() != '')
				{
					$pdo->exec('INSERT INTO people_persons_data (person_id, field_id, int_data) VALUES('.$person_id.','.intval($field_id).','.intval($field_data).')');
				}
				else
				{
					$pdo->exec('INSERT INTO people_persons_data (person_id, field_id, data) VALUES('.$person_id.','.intval($field_id).','.$pdo->quote($field_data).')');
				}
			}
			return $person_id;
		}

		return FALSE;
	}

	/**
	 * Get fields
	 *
	 * @return arr
	 */
	public static function get_fields()
	{
		$pdo = Kohana_pdo::instance();

		$fields = array();
		foreach ($pdo->query('SELECT id, name, `table` FROM people_data_fields;')->fetchAll(PDO::FETCH_ASSOC) as $row)
		{
			$options = array();

			if ($row['table'] == 'people_persons')
			{
				if (!isset($people_persons))
				{
					$sql = '
						SELECT
							people_persons.id,
							(
								SELECT
									people_persons_data.data
								FROM
									people_persons_data
								WHERE
									people_persons_data.field_id =
									(
										SELECT people_data_fields.id FROM people_data_fields WHERE people_data_fields.name = \'lastname\'
									) AND
									people_persons_data.person_id = people_persons.id
							) AS lastname,
							(
								SELECT
									people_persons_data.data
								FROM
									people_persons_data
								WHERE
									people_persons_data.field_id =
									(
										SELECT people_data_fields.id FROM people_data_fields WHERE people_data_fields.name = \'firstname\'
									) AND
									people_persons_data.person_id = people_persons.id
							) AS firstname
						FROM
							people_persons
					';
					$people_persons = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
				}
				$options['0option'] = array(
					'@value'   => '',
					'$content' => 'Unknown',
					'@sorting' => '0',
				);
				foreach ($people_persons as $nr => $data)
				{
					$options[($nr + 1) . 'option'] = array(
						'@value'   => $data['id'],
						'$content' => $data['lastname'].', '.$data['firstname'],
						'@sorting' => $data['lastname'].', '.$data['firstname'],
					);
				}
			}
			elseif ($row['table'] == 'i18n_territories')
			{
				$sql = '
					SELECT
						code,
						(
							SELECT
								i18n_territories_names.name
							FROM
								i18n_territories_names
							WHERE
								i18n_territories_names.territory = i18n_territories.code AND
								i18n_territories_names.language = \'en\'
						) AS name
					FROM
						i18n_territories
				';

				$options['0option'] = array(
					'@value'   => '',
					'$content' => 'Unknown',
					'@sorting' => '0',
				);
				foreach ($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC) as $nr => $territory)
				{
					$options[($nr + 1) . 'option'] = array(
						'@value'   => $territory['code'],
						'$content' => $territory['name'],
						'@sorting' => $territory['name'],
					);
				}
			}
			elseif ($row['table'] == 'i18n_languages')
			{
				$sql = '
					SELECT
						code,
						(
							SELECT
								i18n_languages_names.name
							FROM
								i18n_languages_names
							WHERE
								i18n_languages_names.language_code = i18n_languages.code AND
								i18n_languages_names.language = \'en\'
						) AS name
					FROM
						i18n_languages
				';

				$options['0option'] = array(
					'@value'   => '',
					'$content' => 'Unknown',
					'@sorting' => '0',
				);
				foreach ($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC) as $nr => $language)
				{
					$options[($nr + 1) . 'option'] = array(
						'@value'   => $language['code'],
						'$content' => $language['name'],
						'@sorting' => $language['name'],
					);
				}
			}

			$fields[] = array(
				'id'      => $row['id'],
				'name'    => $row['name'],
				'options' => $options,
			);
		}

		return $fields;
	}

	public static function get_people()
	{
		$pdo = Kohana_pdo::instance();


	}

}
