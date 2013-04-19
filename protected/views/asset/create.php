<?php
/* @var $this AssetController */
/* @var $asset Asset */

$this->breadcrumbs=array(
	'Assets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Assets', 'url'=>array('index')),
);
?>

<h1>Create Asset</h1>

<?php echo $this->renderPartial('_form', array('asset'=>$asset, 'ingredients'=>$ingredients,)); ?>