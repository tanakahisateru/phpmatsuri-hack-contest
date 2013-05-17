<?php
$this->breadcrumbs=array(
	$model->title,
);

?>

<div class="row">

	<div class="span8">
		<div class="view">
		<h1>
			<?php echo CHtml::encode($model->title); ?>
			<small><?php echo CHtml::encode($model->sequence); ?></small>
		</h1>

		<div class="text-right">
			by
			<?php echo CHtml::encode($model->user->fullName); ?>

			<?php if (!$model->user->hideTwitterName): ?>
				(<?php echo CHtml::link(
					CHtml::encode('@' . $model->user->twitterName),
					'http://twitter.com/' . $model->user->twitterName,
					array(
						'target' => '_blank',
					)
				); ?>)
			<?php endif; ?>
		</div>

		<p><?php echo Yii::app()->format->ntext($model->description); ?></p>
		</div>
	</div>

	<div class="span4">
		<h3>Your review...</h3>
		star
		comment
		save
	</div>
</div>
