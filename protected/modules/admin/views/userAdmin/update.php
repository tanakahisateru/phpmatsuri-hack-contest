<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Users'=>array('admin'),
	$model->twitterName=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('admin')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update <?php echo $model->twitterName; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>