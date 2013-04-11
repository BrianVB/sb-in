<?php
/* @var $this IngredientController */
/* @var $ingredient Ingredient */

$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	$ingredient->name=>array('view','id'=>$ingredient->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Ingredient', 'url'=>array('create')),
	array('label'=>'Manage Ingredients', 'url'=>array('index')),
);
?>

<h1>Update Ingredient <?php echo $ingredient->id; ?></h1>

<?php echo $this->renderPartial('_form', array('ingredient'=>$ingredient, 'hop'=>$hop, 'grain'=>$grain)); ?>