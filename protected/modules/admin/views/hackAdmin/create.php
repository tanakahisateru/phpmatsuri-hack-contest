<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Hacks'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hack','url'=>array('admin')),
);
?>

<h1>Create Hack</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>