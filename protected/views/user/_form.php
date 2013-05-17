<?php
/* @var $model User */
/* @var $form TbActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php if (empty($withoutTwitterName)) :?>
	<?php echo $form->textFieldRow($model,'twitterName',array('class'=>'span5','maxlength'=>255)); ?>
	<?php endif; ?>

	<?php if (empty($withoutTwitterName)) :?>
		<?php echo $form->checkBoxRow($model,'isAdmin'); ?>
	<?php endif; ?>

	<?php echo $form->checkBoxRow($model,'hideTwitterName'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
