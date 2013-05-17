<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse',
	'brand'=>Yii::app()->name,
	'brandUrl'=>Yii::app()->request->baseUrl,
	'items'=>array(
		//array(
		//	'class'=>'bootstrap.widgets.TbMenu',
		//	'items'=>array(
		//		array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
		//	),
		//),
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
				array(
					'label'=>'Login with Twitter',
					'url'=>array('/site/twitterLogin'),
					'visible'=>Yii::app()->user->isGuest
				),
				array(
					'label'=>Yii::app()->user->name,
					'url' => '#',
					'items'=>array(
						array(
							'label'=>'Personal Home',
							'icon'=>'home',
							'url'=>array('/user/profile'),
						),
						array(
							'label'=>'Logout',
							'icon'=>'off',
							'url'=>array('/site/logout')
						),
						array(
							'label'=>'Show users',
							'url'=>array('/user/admin'),
							'visible'=>Yii::app()->user->isAdmin,
						),
					),
					'visible'=>!Yii::app()->user->isGuest,
				),
			),
		),
	),
));
?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
	<?php endif; ?>

	<?php $this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'×', // close link text - if set to false, no close link is displayed
	)); ?>

	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->

<div id="footer">
	<?php echo Yii::powered(); ?>
</div><!-- footer -->

</body>
</html>
