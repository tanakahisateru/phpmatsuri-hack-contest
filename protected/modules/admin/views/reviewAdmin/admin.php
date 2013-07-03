<?php
$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'Reviews',
);

$this->menu=array(
	array('label'=>'Create Review','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('review-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Reviews</h1>

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
	'id'=>'review-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name'=>'hackSequence',
			'value'=>'$data->hack->sequence',
		),
		array(
			'name'=>'hackTitle',
			'type'=>'raw',
			'value'=>'CHtml::link(
				$data->hack->title,
				array("/admin/hackAdmin/view", "id"=>$data->hackId)
			)'
		),
		array(
			'name'=>'userTwitterName',
			'type'=>'raw',
			'value'=>'CHtml::link(
				$data->user->twitterName,
				array("/admin/userAdmin/view", "id"=>$data->userId)
			)'
		),
		array(
			'name'=>'point',
			'value'=>'$data->pointAsText . " (" . $data->point . ")"',
		),
		//'comment',
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