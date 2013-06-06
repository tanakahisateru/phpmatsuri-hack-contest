<?php
/* @var $model Hack */
$this->breadcrumbs=array(
	$model->user->twitterName=>array('user/profile'),
	Yii::t('app', 'Hack Entry'),
);

$this->menu=array(
	array(
		'label'=>Yii::t('app', 'Personal Home'),
		'icon'=>'home',
		'url'=>array('user/profile'),
	),
	array(
		'label'=>Yii::t('app', 'Retire'),
		'icon'=>'remove',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array('retire'),
			'confirm'=>Yii::t('app', 'Are you sure you want to retire from the hack contest?')
		),
		'visible'=>!$model->isNewRecord
	),
);
?>

<h1><?php echo Yii::t('app', 'Hack contest entry'); ?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
)); ?>
