<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $fullName
 * @property string $twitterName
 * @property integer $isAdmin
 * @property integer $hideTwitterName
 *
 * The followings are the available model relations:
 * @property Hack $hack
 * @property Review[] $reviews
 */
class User extends CActiveRecord
{
	public $deletionBlockingReason = null;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullName, twitterName, isAdmin, hideTwitterName', 'required'),
			array('fullName, twitterName', 'length', 'max'=>255),
			array('fullName, hideTwitterName', 'required', 'on'=>'profile'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fullName, twitterName, isAdmin, hideTwitterName', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'hack' => array(self::HAS_ONE, 'Hack', 'userId'),
			'reviews' => array(self::HAS_MANY, 'Review', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fullName' => Yii::t('app', 'Full Name'),
			'twitterName' => Yii::t('app', 'Twitter Name'),
			'isAdmin' => Yii::t('app', 'Admin User'),
			'hideTwitterName' => Yii::t('app', 'Hide Twitter Name'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fullName',$this->fullName,true);
		$criteria->compare('twitterName',$this->twitterName,true);
		$criteria->compare('isAdmin',$this->isAdmin);
		$criteria->compare('hideTwitterName',$this->hideTwitterName);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function canDeleteSafer()
	{
		if ($this->hack) {
			$this->deletionBlockingReason = Yii::t('app', "Already registered as presenter. First retire from the hack contest.");
			return false;
		}
		return true;
	}

	protected function beforeDelete()
	{
		foreach($this->reviews as $review) {
			$review->delete();
		}
		if($this->hack) {
			$this->hack->delete();
		}
		return true;
	}

	/**
	 * @param string $twitterName
	 * @return User
	 */
	public function findByTwitterName($twitterName)
	{
		return $this->findByAttributes(array(
			'twitterName' => $twitterName,
		));
	}

	public function getCurrentUser()
	{
		/* @var $webUser CWebUser */
		$webUser = Yii::app()->user;
		if($webUser->isGuest) {
			return null;
		}
		else {
			return self::model()->findByTwitterName($webUser->name);
		}
	}
}