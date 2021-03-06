<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Manage Transactions', 'url'=>array('index')),
	array('label'=>'Create Transaction', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#transaction-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Transactions</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'transaction'=>$transaction,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transaction-grid',
	'dataProvider'=>$transaction->search(),
	'filter'=>$transaction,
	'columns'=>array(
		'id',
		'organization_id',
		'amount',
		'tax',
		'date',
		'create_time',
		/*
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
