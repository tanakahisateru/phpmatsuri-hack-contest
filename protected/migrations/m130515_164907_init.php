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

		$this->createTable('hack', array(
			'id' => 'pk',
			'userId' => 'integer NOT NULL',
			'title' => 'string NOT NULL',
			'description' => 'text',
		));
		$this->addForeignKey('hack_fk_userId', 'hack', 'userId', 'user', 'id');

		$this->createTable('review', array(
			'id' => 'pk',
			'userId' => 'integer NOT NULL',
			'hackId' => 'integer NOT NULL',
			'point' => 'integer',
			'comment' => 'text',
		));
		$this->addForeignKey('review_fk_userId', 'review', 'userId', 'user', 'id');
		$this->addForeignKey('review_fk_hackId', 'review', 'hackId', 'hack', 'id');
	}

	public function down()
	{
		$this->dropTable('review');
		$this->dropTable('hack');
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