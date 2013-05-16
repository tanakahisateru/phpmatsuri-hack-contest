<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->twitterName,
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','name'=>$model->twitterName)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array(
		'submit'=>array('delete','name'=>$model->twitterName),
		'confirm'=>'Are you sure you want to delete this item?')
	),
	array('label'=>'Manage User','url'=>array('admin')),
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
