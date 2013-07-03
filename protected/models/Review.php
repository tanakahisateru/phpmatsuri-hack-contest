<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property integer $userId
 * @property integer $hackId
 * @property integer $point
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Hack $hack
 * @property User $user
 *
 * @property string $pointAsText
 *
 * @method Review commented()
 */
class Review extends CActiveRecord
{
	/**
	 * @var string for search
	 */
	public $hackSequence;

	/**
	 * @var string for search
	 */
	public $hackTitle;

	/**
	 * @var string for search
	 */
	public $userTwitterName;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Review the static model class
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
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, hackId, point', 'required'),
			array('userId, hackId, point', 'numerical', 'integerOnly'=>true),
			array('point', 'in', 'range'=>array_keys($this->pointLabels())),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, hackId, point, comment, hackSequence, hackTitle, userTwitterName', 'safe', 'on'=>'search'),
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
			'hack' => array(self::BELONGS_TO, 'Hack', 'hackId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => Yii::t('app', 'User'),
			'hackId' => Yii::t('app', 'Hack'),
			'point' => Yii::t('app', 'Point'),
			'comment' => Yii::t('app', 'Comment'),

			'userTwitterName' => Yii::t('app', 'Reviewer'),
			'hackSequence' => Yii::t('app', 'Sequence Number'),
			'hackTitle' => Yii::t('app', 'Title'),
		);
	}

	public function scopes()
	{
		return array(
			'commented'=>array(
				'condition'=>'comment IS NOT NULL',
				'order'=>'id', // TODO timestamp
			),
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
		$criteria->with = array('hack', 'user');

		$criteria->compare('id',$this->id);
		//$criteria->compare('userId',$this->userId);
		//$criteria->compare('hackId',$this->hackId);
		$criteria->compare('hack.sequence',$this->hackSequence, true);
		$criteria->compare('hack.title',$this->hackTitle, true);
		$criteria->compare('user.twitterName',$this->userTwitterName, true);

		$criteria->compare('point',$this->point);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes' => array(
					'hackSequence'=>array(
						'asc'=>'hack.sequence',
						'desc'=>'hack.sequence DESC',
						'label'=>$this->getAttributeLabel('hackSequence'),
						'default'=>'asc',
					),
					'hackTitle'=>array(
						'asc'=>'hack.title',
						'desc'=>'hack.title DESC',
						'label'=>$this->getAttributeLabel('hackTitle'),
						'default'=>'asc',
					),
					'userTwitterName'=>array(
						'asc'=>'user.twitterName',
						'desc'=>'user.twitterName DESC',
						'label'=>$this->getAttributeLabel('userTwitterName'),
						'default'=>'asc',
					),
					'*',
				),
			),
		));
	}

	protected function beforeValidate()
	{
		$this->comment = trim($this->comment, "\r\n\t ");
		if (empty($this->comment)) {
			$this->comment = null;
		}
		return true;
	}

	public function pointLabels()
	{
		return array(
			1 => Yii::t('app', 'Good'),
			2 => Yii::t('app', 'Great'),
			3 => Yii::t('app', 'Awesome'),
		);
	}

	public function getPointAsText()
	{
		$labels = $this->pointLabels();
		return isset($labels[$this->point]) ? $labels[$this->point] : $this->point;
	}
}