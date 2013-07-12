<?php

/**
 * This is the model class for table "hack".
 *
 * The followings are the available columns in table 'hack':
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property string $description
 * @property integer $isApproved
 * @property string $sequence
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Review[] $reviews
 *
 * @method Hack approved()
 *
 * @property CArrayDataProvider reviewsDataProvider
 */
class Hack extends CActiveRecord
{
	/** @var string for search */
	public $userTwitterName;

	/** @var string for report */
	public $userFullName;

	/** @var int for report */
	public $totalPoints;

	/** @var float for report */
	public $averagePoints;

	/** @var int for report */
	public $totalReviewers;

	/** @var int for report */
	public $totalComments;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hack the static model class
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
		return 'hack';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, title', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('isApproved', 'boolean'),
			array('title, sequence', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, title, description, isApproved, sequence', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'reviews' => array(self::HAS_MANY, 'Review', 'hackId'),
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
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'isApproved' => Yii::t('app', 'Approved'),
			'sequence' => Yii::t('app', 'SEQ'),
			'userTwitterName' => Yii::t('app', 'Twitter Name'),
			'userFullName' => Yii::t('app', 'Full Name'),

			'totalPoints' => Yii::t('app', 'Total'),
			'totalReviewers' => Yii::t('app', 'Reviewers'),
			'averagePoints' => Yii::t('app', 'Average'),
			'totalComments' => Yii::t('app', 'Comments'),
		);
	}

	public function scopes()
	{
		return array(
			'approved'=>array(
				'condition'=>'isApproved<>0 AND sequence IS NOT NULL',
				'order'=>'sequence',
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
		$criteria->with = array('user', 'reviews');

		$criteria->compare('id',$this->id);
		//$criteria->compare('userId',$this->userId);
		$criteria->compare('user.twitterName',$this->userTwitterName, true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes' => array(
					'userFullName'=>array(
						'asc'=>'user.fullName',
						'desc'=>'user.fullName DESC',
						'label'=>$this->getAttributeLabel('userFullName'),
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

	public function getReviewsDataProvider()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('user');
		$criteria->addCondition('t.hackId = :hackId');
		$criteria->params = array('hackId'=>$this->id);
		return new CActiveDataProvider(Review::model(), array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes' => array(
					'id',
					'point',
				),
			),
			'pagination'=>false,
		));
	}

	/**
	 * @return CDbCriteria
	 */
	protected function createReportCriteriaBase()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('user', 'reviews');
		$criteria->scopes = 'approved';
		$criteria->group = 't.id';
		$criteria->select = array(
			't.sequence as sequence',
			't.title as title',
			'user.twitterName as userTwitterName',
			'user.fullName as userFullName',
			'sum(reviews.point) as totalPoints',
			'count(reviews.id) as totalReviewers',
			'avg(reviews.point) as averagePoints',
			'count(reviews.comment) as totalComments',
		);
		return $criteria;
	}

	/**
	 *
	 * @return Hack[]
	 */
	public function getReportData()
	{
		$criteria = $this->createReportCriteriaBase();
		$criteria->order = 'sequence';
		return $this->findAll($criteria);
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function getReportDataProvider()
	{
		$criteria = $this->createReportCriteriaBase();

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'userFullName'=>array(
						'asc'=>'user.fullName',
						'desc'=>'user.fullName DESC',
						'label'=>$this->getAttributeLabel('userFullName'),
						'default'=>'asc',
					),
					'userTwitterName'=>array(
						'asc'=>'user.twitterName',
						'desc'=>'user.twitterName DESC',
						'label'=>$this->getAttributeLabel('userTwitterName'),
						'default'=>'asc',
					),
					'totalPoints' => array(
						'asc'=>'totalPoints',
						'desc'=>'totalPoints DESC',
						'default'=>'desc',
					),
					'averagePoints' => array(
						'asc'=>'averagePoints',
						'desc'=>'averagePoints DESC',
						'default'=>'desc',
					),
					'totalReviewers' => array(
						'asc'=>'totalReviewers',
						'desc'=>'totalReviewers DESC',
						'default'=>'desc',
					),
					'totalComments' => array(
						'asc'=>'totalComments',
						'desc'=>'totalComments DESC',
						'default'=>'desc',
					),
					'*',
				),
			),
			'pagination'=>false,
		));
	}

	protected function beforeSave()
	{
		if (User::model()->findByPk($this->userId) === null) {
			$this->addError('userId', "User does not exist.");
			return false;
		}
		$this->sequence = trim($this->sequence);
		if (empty($this->sequence)) {
			$this->sequence = null;
		}
		return true;
	}

	protected function beforeDelete()
	{
		foreach($this->reviews as $review) {
			$review->delete();
		}
		return true;
	}

	/**
	 * @return Review[]
	 */
	public function getCommentedReviews()
	{
		return Review::model()->commented()->findAllByAttributes(array(
			'hackId'=>$this->id,
		));
	}

	/**
	 * @param User $user
	 * @return Review
	 */
	public function getReviewOf($user)
	{
		if (empty($user)) {
			return null;
		}
		return Review::model()->findByAttributes(array(
			'userId' => $user->id,
			'hackId' => $this->id,
		));
	}
}
