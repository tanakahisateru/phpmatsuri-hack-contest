<?php
/* @var $model Hack */
$this->breadcrumbs=array(
	$model->user->twitterName=>array('user/profile'),
	'Contest Entry',
);

$this->menu=array(
	array(
		'label'=>'User Home',
		'icon'=>'home',
		'url'=>array('user/profile'),
	),
	array(
		'label'=>'Retire',
		'icon'=>'remove',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array('retire'),
			'confirm'=>'Are you sure you want to retire from the hack contest?'
		),
		'visible'=>!$model->isNewRecord
	),
);
?>

<h1>Hack contest entry</h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'withoutUserId'=>true,
)); ?>
