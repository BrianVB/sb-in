<?php
/* @var $this RecipeController */
/* @var $recipe Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	$recipe->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Recipe', 'url'=>array('create')),
	array('label'=>'Manage Recipes', 'url'=>array('index')),
);
?>

<h1>Update Recipe <?php echo $recipe->id; ?></h1>

<?php echo $this->renderPartial('_form', array('recipe'=>$recipe)); ?>