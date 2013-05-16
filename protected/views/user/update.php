<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->twitterName=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','name'=>$model->twitterName)),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<h1>Update <?php echo $model->twitterName; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>