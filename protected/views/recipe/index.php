<?php
/* @var $this RecipeController */
/* @var $recipe Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Manage Recipes', 'url'=>array('index')),
	array('label'=>'Create Recipe', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#recipe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Recipes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'recipe'=>$recipe,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'recipe-grid',
	'dataProvider'=>$recipe->search(),
	'filter'=>$recipe,
	'columns'=>array(
		'id',
		'name',
		'days_in_primary',
		'days_in_secondary',
		'days_in_tertiary',
		'starting_gravity',
		/*
		'ending_gravity',
		'process',
		'create_time',
		'update_time',
		'created_by',
		'updated_by',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',			
		),
	),
)); ?>
