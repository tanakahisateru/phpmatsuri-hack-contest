<?php

class m130713_231756_dbsession extends CDbMigration
{
	public function up()
	{
		$this->createTable('http_session', array(
			'id' => 'CHAR(32)',
			'expire' => 'INTEGER',
			'data' => 'BLOB',
		), 'ENGINE=InnoDB CHARSET=utf8');
		$this->addPrimaryKey('pk_id', 'http_session', 'id');
		return true;
	}

	public function down()
	{
		$this->dropTable('http_session');
		return true;
	}
}