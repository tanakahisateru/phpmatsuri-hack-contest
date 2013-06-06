<?php
$this->beginWidget('CMarkdown', array(
	'purifyOutput'=>true,
));
echo $data;
$this->endWidget();
