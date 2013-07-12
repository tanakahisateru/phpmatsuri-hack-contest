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
		<div class="trimmed-box">
			<h1>
				<span class="label label-info"><?php echo CHtml::encode($model->sequence); ?></span><br />
				<?php echo CHtml::encode($model->title); ?>
			</h1>

			<div class="text-right">
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

			<?php
				$this->beginWidget('CHtmlPurifier', array(
					'options' => Yii::app()->params['htmlPurifierOptions'],
				));
				$this->beginWidget('CMarkdown', array( ));
				echo $model->description;
				$this->endWidget();
				$this->endWidget();
			?>
		</div>

		<h3><?php echo Yii::t('app', 'Reviewer comments'); ?></h3>
		<div>
			<?php foreach($model->getCommentedReviews() as $commentedReview): ?>
				<div class="view clearfix">
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
			<?php if($model->user->twitterName == Yii::app()->user->name) : ?>
				<p><?php echo CHtml::encode(Yii::t('app', 'This hack is yours.')); ?></p>
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'link',
					'icon'=>'edit',
					'url'=>array('register', 'from'=>'reviewPage'),
					'label'=>Yii::t('app', 'Manage Hack Entry'),
				)); ?>
			<?php else : ?>
				<h3><?php echo Yii::t('app', 'Your review...'); ?></h3>
				<?php if (!$review->isNewRecord): ?>
					<div style="margin-bottom: 30px;">
						<span class="review-summary">
							<?php echo CHtml::encode($review->pointAsText); ?>
						</span>
						<span id="update-review">
							<?php echo CHtml::link(
								'<i class="icon-chevron-down"></i>' . Yii::t('app', 'Update'),
								'#'
							); ?>
						</span>
					</div>
				<?php endif; ?>

				<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
					'id'=>'review-form',
					'enableAjaxValidation'=>true,
				)); ?>

				<?php echo $form->errorSummary($review); ?>

				<?php echo $form->radioButtonListInlineRow($review,'point', $review->pointLabels(), array(
					'label'=>false,
				)); ?>

				<?php echo $form->textAreaRow($review,'comment',array('rows'=>3, 'class'=>'span4')); ?>

				<div><?php echo CHtml::encode(Yii::t('app',
					'If you missed this presentation or have nothing to say, leave it nothing posted as is.'
				)); ?></div>

				<div class="form-actions">
					<?php $this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'submit',
						'type'=>'primary',
						'label'=>$review->isNewRecord ? Yii::t('app', 'Post') : Yii::t('app', 'Update'),
					)); ?>
					<?php $this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'link',
						'type'=>'danger',
						'label'=>Yii::t('app', 'Delete'),
						'url'=>'#',
						'htmlOptions'=>array(
							'submit'=>array('deleteReview','id'=>$model->id),
							'confirm'=>Yii::t('app', 'Are you sure you want to delete this review?')
						),
						'visible'=>!$review->isNewRecord
					)); ?>
				</div>

				<?php $this->endWidget(); ?>
			<?php endif; ?>
		<?php else: ?>
			<p class="text-center"><?php echo Yii::t('app', 'You can authorize yourself with Twitter. Join now!'); ?></p>
			<div class="text-center">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'link',
					'type'=>'primary',
					'size'=>'large',
					'url'=>array('site/twitterLogin'),
					'label'=>Yii::t('app', 'Login with Twitter'),
				)); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php Yii::app()->clientScript->registerScript('toggle', "
$(function(){
	var updateReview = $('#update-review');
	var reviewForm = $('#review-form');
	if (updateReview.length > 0) {
		reviewForm.hide();
		updateReview.find('a').click(function() {
			reviewForm.slideToggle();
			return false;
		})
	}
});
"); ?>