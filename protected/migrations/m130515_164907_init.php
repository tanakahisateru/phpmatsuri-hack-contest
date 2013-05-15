<?php

class m130515_164907_init extends CDbMigration
{
	public function up()
	{
		$this->createTable('user', array(
			'id' => 'pk',
			'fullName' => 'string NOT NULL',
			'twitterName' => 'string NOT NULL',
		));
		$this->createIndex('fullName', 'user', 'fullName');
		$this->createIndex('twitterName', 'user', 'twitterName');
	}

	public function down()
	{
		$this->dropTable('user');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}