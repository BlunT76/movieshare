<?php

namespace Fuel\Migrations;

class Create_films
{
	public function up()
	{
		\DBUtil::create_table('films', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'title' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
			'year' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'director' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
			'actors' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
			'runtime' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
			'plot' => array('null' => false, 'type' => 'text'),
			'rented' => array('null' => false, 'type' => 'bool'),
			'poster' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('films');
	}
}