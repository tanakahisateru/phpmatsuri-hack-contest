<?php
/* @var $data Hack */
?>
<div class="span3">
	<div class="view trimmed-box clearfix">

		<h4>
			<?php echo CHtml::link(
				CHtml::encode($data->title),
				array('hack/review', 'id'=>$data->id)
			); ?>
			<span class="label label-info"><?php echo CHtml::encode($data->sequence); ?></span>
		</h4>

		<div class="text-right">
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

		<?php if (!Yii::app()->user->isGuest): ?>
			<div>
				<?php $review = $data->getReviewOf(Yii::app()->user->asDbUser()); ?>
				<?php if ($review): ?>
					<?php echo Yii::t('app', 'Your review...'); ?>
					<?php echo CHtml::encode($review->pointAsText); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</div>