<?php
/* @var $model User */

$this->breadcrumbs=array(
	$model->twitterName=>array('profile'),
	'Change Profile',
);

$this->menu=array(
	array('label'=>'User Home','url'=>array('profile')),
	array('label'=>'Remove me!','url'=>'#','linkOptions'=>array(
		'submit'=>array('removeMe'),
		'confirm'=>'Are you sure you want to leave from this service eternally?')
	),
);
?>

<h1><?php echo CHtml::encode($model->twitterName); ?></h1>

<p>Change your profile in this application.</p>

<?php echo $this->renderPartial('_form',array(
	'model'=>$model,
	'withoutTwitterName'=>true,
)); ?>