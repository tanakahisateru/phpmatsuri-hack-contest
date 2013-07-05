<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Hacks'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Hack','url'=>array('admin')),
	array('label'=>'Create Hack','url'=>array('create')),
	array('label'=>'Update Hack','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Hack','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Hack #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'userFullName',
			'type'=>'raw',
			'value'=>CHtml::link(
				$model->user->fullName,
				array('/admin/userAdmin/view', 'id'=>$model->userId)
			),
		),
		array(
			'name'=>'userTwitterName',
			'type'=>'raw',
			'value'=>CHtml::link(
				"@" . $model->user->twitterName,
				"http://twitter.com/" . $model->user->twitterName,
				array(
					"target" => "_blank",
				)
			),
		),
		'title',
		array(
			'name' => 'description',
			'type'=>'raw',
			'value' => $this->renderPartial('_mdtext', array(
				'data' => $model->description,
			), true),
		),
		'isApproved:boolean',
		'sequence',
	),
)); ?>

<h2>Reviews</h2>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'review-grid',
		'dataProvider'=>$model->reviewsDataProvider,
		'columns'=>array(
			'id',
			'user.fullName',
			'user.twitterName',
			array(
				'name'=>'point',
				'value'=>'sprintf("%s (%d)", $data->pointAsText, $data->point)'
			),
			'comment:ntext',
		),
	)); ?>
