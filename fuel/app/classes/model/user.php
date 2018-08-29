<?php
use Orm\Model;

class Model_User extends Model
{
	protected static $_has_one = array('rented');
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'email',
		'role',
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
		$val->add_field('username', 'Username', 'required|max_length[255]');
		$val->add_field('password', 'Password', 'required|max_length[255]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		//$val->add_field('role', 'Role', 'required|max_length[255]');

		return $val;
	}

}
