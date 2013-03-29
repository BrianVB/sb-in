<?php
/* @var $this IngredientController */
/* @var $ingredient Ingredient */

$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Ingredients', 'url'=>array('index')),
);
?>

<h1>Create Ingredient</h1>

<?php echo $this->renderPartial('_form', array('ingredient'=>$ingredient)); ?>