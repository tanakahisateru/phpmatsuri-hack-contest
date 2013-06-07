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
			array('id, userId, hackId, point, comment', 'safe', 'on'=>'search'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('hackId',$this->hackId);
		$criteria->compare('point',$this->point);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
			1 => Yii::t('app', 'Even'),
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