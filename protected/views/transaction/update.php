<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$transaction->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Transaction', 'url'=>array('create')),
	array('label'=>'Manage Transactions', 'url'=>array('index')),
);
?>

<h1>Update Transaction <?php echo $transaction->id; ?></h1>

<?php echo $this->renderPartial('_form', array('transaction'=>$transaction)); ?>