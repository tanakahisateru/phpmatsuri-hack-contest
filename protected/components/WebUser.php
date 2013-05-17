<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tanakahisateru
 * Date: 2013/05/18
 * Time: 1:44
 * To change this template use File | Settings | File Templates.
 */

class WebUser extends CWebUser {

	/**
	 * @return User
	 */
	public function asDbUser()
	{
		if ($this->isGuest) {
			return null;
		}
		return User::model()->findByTwitterName($this->name);
	}

	/**
	 * @return bool
	 */
	public function getIsAdmin()
	{
		if ($this->isGuest) {
			return false;
		}
		if (array_key_exists($this->name, Yii::app()->params['systemUserMD5Passwords'])) {
			return true;
		}
		$dbUser = $this->asDbUser();
		return $dbUser && $dbUser->isAdmin;
	}
}