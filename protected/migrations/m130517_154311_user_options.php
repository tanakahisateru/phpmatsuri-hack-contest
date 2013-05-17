<?php

class m130517_154311_user_options extends CDbMigration
{
	public function up()
	{
		$this->addColumn('user', 'isAdmin', 'bool NOT NULL');
		$this->addColumn('user', 'hideTwitterName', 'bool NOT NULL');

		$this->addColumn('hack', 'isApproved', 'bool NOT NULL');
		$this->addColumn('hack', 'sequence', 'string');
		$this->createIndex('isApproved', 'hack', 'isApproved');
		$this->createIndex('sequence', 'hack', 'sequence');
	}

	public function down()
	{
		$this->dropIndex('isApproved', 'hack');
		$this->dropIndex('sequence', 'hack');
		$this->dropColumn('hack', 'isApproved');
		$this->dropColumn('hack', 'sequence');

		$this->dropColumn('user', 'isAdmin');
		$this->dropColumn('user', 'hideTwitterName');
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