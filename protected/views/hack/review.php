<?php
/* @var $model Hack */
/* @var $review Review */
/* @var $form TbActiveForm */

$this->breadcrumbs=array(
	$model->title,
);

?>

<div class="row">

	<div class="span8">
		<div class="view">
			<h1>
				<?php echo CHtml::encode($model->title); ?>
				<span class="label label-info"><?php echo CHtml::encode($model->sequence); ?></span>
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

		<h3>Reviewer comments</h3>
		<div>
			<?php foreach($model->getCommentedReviews() as $commentedReview): ?>
				<div class="view">
					<i><?php echo Yii::app()->format->ntext($commentedReview->comment); ?></i>
					<div class="pull-right">
						<small>
							by
							<?php echo CHtml::encode($commentedReview->user->fullName); ?>
							<?php if (!$commentedReview->user->hideTwitterName): ?>
								(<?php echo CHtml::link(
									CHtml::encode('@' . $commentedReview->user->twitterName),
									'http://twitter.com/' . $commentedReview->user->twitterName,
									array(
										'target' => '_blank',
									)
								); ?>)
							<?php endif; ?>
						</small>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="span4">
		<?php if(!Yii::app()->user->isGuest) : ?>
			<h3>Your review...</h3>
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'review-form',
				'enableAjaxValidation'=>true,
			)); ?>

			<?php echo $form->errorSummary($review); ?>

			<?php echo $form->radioButtonListInlineRow($review,'point', $review->pointLabels()); ?>

			<?php echo $form->textAreaRow($review,'comment',array('rows'=>3, 'class'=>'span4')); ?>

			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$review->isNewRecord ? 'Post' : 'Update',
				)); ?>
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'link',
					'type'=>'danger',
					'label'=>'Delete',
					'url'=>'#',
					'htmlOptions'=>array(
						'submit'=>array('deleteReview','id'=>$model->id),
						'confirm'=>'Are you sure you want to delete this review?'
					),
					'visible'=>!$review->isNewRecord
				)); ?>
			</div>

			<?php $this->endWidget(); ?>
		<?php else: ?>
			<p class="text-center">You can authorize yourself with Twitter. Join now!</p>
			<div class="text-center">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'link',
					'type'=>'primary',
					'size'=>'large',
					'url'=>array('site/twitterLogin'),
					'label'=>'Login with Twitter',
				)); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
