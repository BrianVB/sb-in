<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$transaction->id=>array('view','id'=>$transaction->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Transaction', 'url'=>array('create')),
	array('label'=>'Manage Transactions', 'url'=>array('index')),
);
?>

<h1>Update Transaction <?php echo $transaction->id; ?></h1>

<?php echo $this->renderPartial('_form', array(
	'transaction'=>$transaction,
	'line_items'=>$line_items
)); ?>


<?php
$line_item_index = count($line_items);
Yii::app()->clientScript->registerScript(
	'line-item-delete',
	'var line_item_index = '.$line_item_index.';
	$("body").on("click", ".line-item .remove", function(){
		if(confirm("Are you sure you want to delete this?")){
			$line_item_row = $(this).closest("tr");
			$.ajax({
				url: "/transaction/deleteLineItem",
				data: { id: $(this).attr("data-id") },
				success: function(){
					$line_item_row.remove();
				}
			});
		}
	});
');
?>