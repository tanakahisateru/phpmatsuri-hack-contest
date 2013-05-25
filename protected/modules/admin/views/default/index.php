<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Admin',
);
?>
<h1>Admin Tools</h1>

<ul>
	<li><?php echo CHtml::link('Manage Users', array('userAdmin/admin')); ?></li>
	<li><?php echo CHtml::link('Manage Hacks', array('hackAdmin/admin')); ?></li>
</ul>