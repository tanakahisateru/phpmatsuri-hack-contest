<?php
/* @var $this SiteController */
/* @var $hacksDataProvider CDataProvider */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
	'heading'=>Yii::app()->name,
)); ?>
	<p class="lead"><?php echo Yii::t('app', 'This is hack contest app for {appName}.', array(
		'{appName}' => Yii::app()->name,
	)); ?></p>
<?php $this->endWidget(); ?>

<?php if (Yii::app()->user->isGuest): ?>
	<p class="text-center"><?php echo Yii::t('app', 'You can authorize yourself with Twitter. Join now!'); ?></p>
	<div class="text-center">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'primary',
			'size'=>'large',
			'url'=>array('twitterLogin'),
			'label'=>Yii::t('app', 'Login with Twitter'),
		)); ?>
	</div>
<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$hacksDataProvider,
	'itemView'=>'_view',
	'itemsCssClass'=>'row',
)); ?>
