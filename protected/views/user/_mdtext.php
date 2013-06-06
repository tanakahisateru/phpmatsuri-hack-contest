<?php
/* @var $data string */
$this->beginWidget('CHtmlPurifier', array(
	'options' => Yii::app()->params['htmlPurifierOptions'],
));
$this->beginWidget('CMarkdown', array( ));
echo $data;
$this->endWidget();
$this->endWidget();
