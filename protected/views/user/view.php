<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->twitterName,
);

$this->menu=array(
	array('label'=>'List User','url'=>array('admin')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array(
		'submit'=>array('delete','id'=>$model->id),
		'confirm'=>'Are you sure you want to delete this item?')
	),
);
?>

<h1>View <?php echo $model->twitterName; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'fullName',
		'twitterName',
	),
)); ?>
