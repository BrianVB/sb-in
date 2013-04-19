<?php
/* @var $this AssetController */
/* @var $asset Asset */

$this->breadcrumbs=array(
	'Assets'=>array('index'),
	$asset->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Asset', 'url'=>array('create')),
	array('label'=>'Manage Assets', 'url'=>array('index')),
);
?>

<h1>Update Asset <?php echo $asset->id; ?></h1>

<?php echo $this->renderPartial('_form', array('asset'=>$asset, 'ingredients'=>$ingredients,)); ?>