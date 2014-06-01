<?php
use Orm\Model;

class Model_Employee extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'surname',
		'email',
		'phonenumber',
		'description',
		'avatar',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[70]');
		$val->add_field('surname', 'Surname', 'required|max_length[70]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[254]');
		$val->add_field('phonenumber', 'Phonenumber', 'required|max_length[8]');
		$val->add_field('description', 'Description', 'required');
		$val->add_field('avatar', 'Avatar', 'max_length[100]');

		return $val;
	}

}
