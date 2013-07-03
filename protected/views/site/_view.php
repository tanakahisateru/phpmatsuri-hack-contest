<?php
/* @var $data Hack */
?>
<div class="span4">
	<div class="view trimmed-box clearfix">

		<span class="label label-info"><?php echo CHtml::encode($data->sequence); ?></span>
		<h4 style="height: 40px;">
			<?php echo CHtml::link(
				CHtml::encode($data->title),
				array('hack/review', 'id'=>$data->id)
			); ?>
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
			<div style="height: 20px;">
				<?php $review = $data->getReviewOf(Yii::app()->user->asDbUser()); ?>
				<?php if ($review): ?>
					<?php echo Yii::t('app', 'Your review...'); ?>
					<span class="badge badge-important">
					<?php echo CHtml::encode($review->pointAsText); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</div>