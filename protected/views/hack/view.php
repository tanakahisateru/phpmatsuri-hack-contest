<?php
$this->breadcrumbs=array(
	'Hacks'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Hack','url'=>array('admin')),
	array('label'=>'Create Hack','url'=>array('create')),
	array('label'=>'Update Hack','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Hack','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Hack #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'user.twitterName',
		'title',
		'description',
	),
)); ?>
