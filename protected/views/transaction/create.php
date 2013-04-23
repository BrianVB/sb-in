<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Transactions', 'url'=>array('index')),
);
?>

<h1>Create Transaction</h1>

<?php echo $this->renderPartial('_form', array(
	'transaction'=>$transaction,
	'line_items'=>$line_items
)); ?>

<?php
$line_item_index = count($line_items);
Yii::app()->clientScript->registerScript(
	'line-item-remove-html',
	'var line_item_index = '.$line_item_index.';
	$("body").on("click", ".line-item .remove", function(){
		$(this).closest("tr").remove();
	});
');
?>