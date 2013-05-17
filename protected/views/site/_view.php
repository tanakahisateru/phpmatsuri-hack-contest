<?php
/* @var $data Hack */
?>
<div class="span4">
	<div class="view">

		<h4><?php echo CHtml::encode($data->title); ?></h4>

		<div class="text-right">
			by
			<?php echo CHtml::encode($data->user->fullName); ?>

			(<?php echo CHtml::link(
				CHtml::encode('@' . $data->user->twitterName),
				'http://twitter.com/' . $data->user->twitterName,
				array(
					'target' => '_blank',
				)
			); ?>)
		</div>

		<p><?php echo CHtml::encode(mb_strimwidth($data->description, 0, 80, '...', 'utf-8')); ?></p>

		<div class="text-center">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'link',
				'icon'=>'info-sign',
				'url'=>array('hack/review', 'id'=>$data->id),
				'label'=>'Detail',
			)); ?>
		</div>
	</div>
</div>