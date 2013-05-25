<?php
$this->breadcrumbs=array(
	'Hacks'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Hack','url'=>array('admin')),
	array('label'=>'Create Hack','url'=>array('create')),
	array('label'=>'View Hack','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Hack <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>