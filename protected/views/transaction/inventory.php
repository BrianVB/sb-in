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

<h1>Manage Inventory</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-inveotory-form',
)); ?>

	<?php foreach($line_items as $line_item): ?>
		<?php echo $this->renderPartial('_asset_subform', array('line_item'=>$line_item)); ?>
	<?php endforeach; ?>

<?php $this->endWidget(); ?>