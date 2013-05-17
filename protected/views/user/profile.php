<?php
/* @var $model User */

$this->breadcrumbs=array(
	$model->twitterName,
);

$this->menu=array(
	array('label'=>'Change Profile','url'=>array('updateProfile')),
	array('label'=>'Remove me!','url'=>'#','linkOptions'=>array(
		'submit'=>array('removeMe'),
		'confirm'=>'Are you sure you want to leave from this service eternally?')
	),
);
?>

<h1><?php echo CHtml::encode($model->twitterName); ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'fullName',
		'twitterName',
	),
)); ?>

<h2>Contest entry</h2>
<?php if($model->hack): ?>
	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model->hack,
		'attributes'=>array(
			'title',
			'description:ntext',
		),
	)); ?>
<?php else: ?>
	<p>Not registered.</p>
<?php endif; ?>
