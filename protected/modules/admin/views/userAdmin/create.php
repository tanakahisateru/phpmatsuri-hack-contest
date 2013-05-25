<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Users'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('admin')),
);
?>

<h1>Create User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>