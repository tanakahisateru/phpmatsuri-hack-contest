<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Hacks',
);

$this->menu=array(
	array('label'=>'Create Hack','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hack-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Hacks</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'hack-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'userId',
		array(
			'name'=>'userFullName',
			'type'=>'raw',
			'value'=>'CHtml::link(
				$data->user->fullName,
				array("/admin/userAdmin/view", "id"=>$data->userId)
			)'
		),
		array(
			'name'=>'userTwitterName',
			'type'=>'raw',
			'value'=>'CHtml::link(
				"@" . $data->user->twitterName,
				"http://twitter.com/" . $data->user->twitterName,
				array(
					"target" => "_blank",
				)
			)'
		),
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link(
				$data->title,
				array("/hack/review", "id"=>$data->id)
			)'
		),
		'isApproved:boolean',
		'sequence',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'pills',
		'items'=>$this->menu,
		'htmlOptions'=>array('class'=>'operations'),
	)); ?>
</div>