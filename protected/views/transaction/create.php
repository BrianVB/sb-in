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

<?php echo $this->renderPartial('_form', array('transaction'=>$transaction)); ?>