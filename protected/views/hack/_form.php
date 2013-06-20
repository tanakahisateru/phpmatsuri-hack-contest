<?php
/* @var $model Hack */
/* @var $form TbActiveForm */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/js-markdown-extra.js');
Yii::app()->clientScript->registerScript('Hack_description_preview', '
function previewDescriptionMarkdown(){
	var editor = $("#Hack_description");
	var preview = $("#Hack_description_preview");
	preview.css("height", editor.height()).html(Markdown(editor.val()));
}');
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'hack-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->label($model, 'description'); ?>
	<?php $this->widget('bootstrap.widgets.TbTabs', array(
		//'placement' => 'below',
		'tabs' => array(
			array(
				'label'=>Yii::t('app', 'Edit'),
				'content'=>$form->textArea($model,'description',array('rows'=>20, 'cols'=>50, 'class'=>'span8')),
				'active'=>true,
			),
			array(
				'label'=>Yii::t('app', 'Preview'),
				'content'=>'<div id="Hack_description_preview"></div>',
				'linkOptions'=>array(
					'class'=>'preview'
				)
			),
		),
		'events'=>array(
			'show'=>'js:function(event){ if(jQuery(event.target).is(".preview")){ previewDescriptionMarkdown(); } }',
		),
	)); ?>
	<?php echo $form->error($model, 'description', array('class'=>'error')); ?>

	<div class="hint">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'link',
			'icon'=>'book',
			'label'=>'PHP Markdown Reference',
			'url'=>'http://michelf.ca/projects/php-markdown/reference/',
			'htmlOptions'=>array(
				'target'=>'_blank',
			)
		)); ?>
	</div>

	<div class="form-actions">
		<?php $saveLabel = (isset($_GET['from']) && $_GET['from'] == 'reviewPage') ? 'Save and back to the review page' : 'Save'; ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', $saveLabel),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
