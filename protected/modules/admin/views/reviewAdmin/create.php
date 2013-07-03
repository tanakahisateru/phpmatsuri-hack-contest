<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Reviews'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Review','url'=>array('admin')),
);
?>

<h1>Create Review</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>