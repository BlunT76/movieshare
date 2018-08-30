<?php
use Orm\Model;

class Model_Film extends Model
{
	protected static $_properties = array(
		'id',
		'title',
		'year',
		'director',
		'actors',
		'runtime',
		'plot',
		'rented',
		'poster',
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
		//$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('year', 'Year', 'required|valid_string[numeric]');
		$val->add_field('director', 'Director', 'required|max_length[255]');
		$val->add_field('actors', 'Actors', 'required|max_length[255]');
		$val->add_field('runtime', 'Runtime', 'required|max_length[255]');
		$val->add_field('plot', 'Plot', 'required');
		$val->add_field('rented', 'Rented', 'required');
		$val->add_field('poster', 'Poster', 'required|max_length[255]');

		return $val;
	}

}
