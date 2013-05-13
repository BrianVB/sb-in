<?php
/* @var $this RecipeController */
/* @var $recipe Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Recipes', 'url'=>array('index')),
);
?>

<h1>Create Recipe</h1>

<?php echo $this->renderPartial('_form', array('recipe'=>$recipe)); ?>