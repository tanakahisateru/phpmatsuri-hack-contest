<?php
/* @var $model User */

$this->breadcrumbs=array(
	$model->twitterName,
);

$this->menu=array(
	array(
		'label'=>Yii::t('app', 'Change Profile'),
		'icon'=>'user',
		'url'=>array('updateProfile')
	),
	array(
		'label'=>Yii::t('app', 'Manage Hack Entry'),
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

<h2><?php echo Yii::t('app', 'Your Hack'); ?></h2>
<?php if($model->hack): ?>
	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model->hack,
		'attributes'=>array(
			'title',
			'description:ntext',
			'isApproved:boolean',
			'sequence',
		),
	)); ?>
<?php else: ?>
	<p><?php echo Yii::t('app', '... is still not registered. Join to the hack contest now.'); ?></p>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link',
		'url'=>array('hack/register'),
		'label'=>Yii::t('app', 'Register to hack contest'),
	)); ?>
<?php endif; ?>
