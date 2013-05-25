<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('app', 'About');
$this->breadcrumbs=array(
	Yii::t('app', 'About'),
);
?>
<h1>About</h1>

<p><?php echo Yii::t('app', 'This is hack contest app for {appName}.', array(
	'{appName}' => Yii::app()->name,
)); ?></p>
