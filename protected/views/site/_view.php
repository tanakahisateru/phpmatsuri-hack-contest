<?php
/* @var $data Hack */
?>
<div class="view span4">

	<?php echo CHtml::encode($data->user->fullName); ?>

	(<?php echo CHtml::link(
		CHtml::encode('@' . $data->user->twitterName),
		'http://twitter.com/' . $data->user->twitterName,
		array(
			'target' => '_blank',
		)
	); ?>)

	<h4><?php echo CHtml::encode($data->title); ?></h4>
	<p><?php echo CHtml::encode(mb_strimwidth($data->description, 0, 20, '...', 'utf-8')); ?></p>

</div>