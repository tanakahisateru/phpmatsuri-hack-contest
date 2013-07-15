<?php

class HackController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('review', 'deleteReview'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('register','retire'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionRegister()
	{
		if (User::model()->getCurrentUser()->hack) {
			$model=$this->loadCurrentUserModel();
		}
		else {
			$model = new Hack;
			$model->userId = User::model()->getCurrentUser()->id;
			$model->isApproved = false;
		}

		$model->scenario = 'register';

		if(isset($_POST['Hack']))
		{
			$model->attributes=$_POST['Hack'];
			if ($model->save()) {
				if ($model->isNewRecord) {
					Yii::app()->user->setFlash(
						'success',
						Yii::t('app', '<strong>Well done!</strong> You successfully register the contest.')
					);
				}
				if (isset($_GET['from']) && $_GET['from'] == 'reviewPage') {
					$this->redirect(array('review', 'seq'=>$model->sequence));
				}
				else {
					$this->redirect(array('user/profile'));
				}
			}
		}

		$this->render('register',array(
			'model'=>$model,
		));
	}

	public function actionRetire()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadCurrentUserModel();
			if ($model) {
				if ($model->delete()) {
					Yii::app()->user->setFlash(
						'success',
						Yii::t('app', "You've retired from the contest.")
					);
				}
			}
			$this->redirect(array('user/profile'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionReview($seq)
	{
		$this->layout = 'column1';
		$model = $this->loadModelBySequence($seq);
		if(!$model->isApproved) {
			throw new CHttpException(404,'The requested page does not exist.');
		}

		/** @var WebUser $user */
		$user = Yii::app()->user;

		$review = null;
		if (!$user->isGuest) {
			$review = $this->loadOrCreateReviewByCurrentUserFor($model->id);
		}
		if (isset($_POST['Review'])) {

			// Block to post review: start
			throw new CHttpException(403,'This action not allowed. Sorry, this event is already finished.');
			// end

			if ($user->isGuest) {
				throw new CHttpException(403,'This action not allowed.');
			}
			$review->attributes = $_POST['Review'];
			if ($review->save()) {
				Yii::app()->user->setFlash(
					'success',
					Yii::t('app', '<strong>Thanks!</strong> You successfully send your review.')
				);
				$this->redirect(array('review', 'seq'=>$seq));
			}
		}

		$this->render('review',array(
			'model'=>$model,
			'review'=>$review,
		));
	}

	/**
	 * @param integer $id
	 * @throws CHttpException
	 */
	public function actionDeleteReview($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$review = $this->loadOrCreateReviewByCurrentUserFor($id);
			if (!$review->isNewRecord) {
				$review->delete();
				Yii::app()->user->setFlash(
					'success',
					Yii::t('app', 'Your review has been removed.')
				);
			}
			$this->redirect(array('review', 'seq'=>$review->hack->sequence));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Hack the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Hack::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * @return Hack the loaded model
	 * @throws CHttpException
	 */
	public function loadCurrentUserModel()
	{
		$user = User::model()->getCurrentUser();
		$model = $user->hack;
		if($model===null)
			throw new CHttpException(403,'This action not allowed.');
		return $model;
	}

	public function loadOrCreateReviewByCurrentUserFor($id)
	{
		$user = User::model()->getCurrentUser();
		if ($user === null) {
			throw new CHttpException(403,'This action not allowed.');
		}
		$review = Review::model()->findByAttributes(array(
			'userId' => $user->id,
			'hackId' => $id,
		));
		if ($review === null) {
			$review = new Review();
			$review->userId = $user->id;
			$review->hackId = $id;
		}
		return $review;
	}

	/**
	 * @param string $seq
	 */
	private function loadModelBySequence($seq)
	{
		$model=Hack::model()->findByAttributes(array('sequence'=>$seq));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
