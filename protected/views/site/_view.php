<?php
/* @var $data Hack */
?>
<div class="span4">
	<div class="view">

		<h4>
			<?php echo CHtml::encode($data->title); ?>
			<small><?php echo CHtml::encode($data->sequence); ?></small>
		</h4>

		<div class="text-right">
			by
			<?php echo CHtml::encode($data->user->fullName); ?>

			<?php if (!$data->user->hideTwitterName): ?>
				(<?php echo CHtml::link(
					CHtml::encode('@' . $data->user->twitterName),
					'http://twitter.com/' . $data->user->twitterName,
					array(
						'target' => '_blank',
					)
				); ?>)
			<?php endif; ?>
		</div>

		<!--
		<p><?php echo CHtml::encode(mb_strimwidth($data->description, 0, 80, '...', 'utf-8')); ?></p>
		-->

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