<?php
/* @var $model User */

$this->breadcrumbs=array(
	$model->twitterName,
);

$this->menu=array(
	array(
		'label'=>'Change Profile',
		'icon'=>'user',
		'url'=>array('updateProfile')
	),
	array(
		'label'=>'Manage Contest Entry',
		'icon'=>'edit',
		'url'=>array('hack/register'),
		'visible'=>$model->hack ? true : false
	),
);
?>

<h1><?php echo CHtml::encode($model->twitterName); ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'fullName',
		'twitterName',
		'isAdmin:boolean',
		'hideTwitterName:boolean',
	),
)); ?>

<h2>Your presentation</h2>
<?php if($model->hack): ?>
	<div class="view">
		<h3><?php echo CHtml::encode($model->hack->title); ?></h3>
		<p><?php echo Yii::app()->format->ntext($model->hack->description); ?></p>
	</div>
	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model->hack,
		'attributes'=>array(
			'isApproved:boolean',
			'sequence',
		),
	)); ?>
<?php else: ?>
	<p>... is still not registered. Join to the super LT now.</p>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link',
		'url'=>array('hack/register'),
		'label'=>'Register to hack contest',
	)); ?>
<?php endif; ?>
