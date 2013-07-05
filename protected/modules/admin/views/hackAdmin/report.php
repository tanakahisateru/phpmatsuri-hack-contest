<?php
/* @var $model Hack */

$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Report',
);

$this->menu=array(
);
?>

<h1>Hacks Report</h1>

<?php
	$dataProvider = $model->search();
	$dataProvider->pagination = false;
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'hack-grid',
	'dataProvider'=>$model->report(),
	'columns'=>array(
		'sequence',
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link(
				$data->title,
				array("/admin/hackAdmin/view", "id"=>$data->id)
			)'
		),
		array(
			'name'=>'userFullName',
			'type'=>'raw',
			'value'=>'CHtml::link(
				$data->user->fullName,
				array("/admin/userAdmin/view", "id"=>$data->user->id)
			)'
		),
		array(
			'name'=>'userTwitterName',
			'type'=>'raw',
			'value'=>'CHtml::link(
				CHtml::encode("@" . $data->user->twitterName),
				"http://twitter.com/" . $data->user->twitterName,
				array(
					"target" => "_blank",
				)
			)',
		),
		array(
			'name'=>'totalPoints',
			'value'=>'intval($data->totalPoints)',
		),
		'totalReviewers',
		array(
			'name'=>'averagePoints',
			'value'=>'sprintf("%0.2f", $data->averagePoints)',
		),
		'totalComments',
	),
	'enablePagination'=>false,
)); ?>
