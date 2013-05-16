<div class="view">

	<?php echo CHtml::link(
		CHtml::encode($data->fullName),
		array('view', 'name'=>$data->twitterName)
	); ?>

	(<?php echo CHtml::link(
		CHtml::encode('@' . $data->twitterName),
		'http://twitter.com/' . $data->twitterName,
		array(
			'target' => '_blank',
		)
	); ?>)

</div>