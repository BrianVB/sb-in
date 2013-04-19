<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($transaction,'id'); ?>
		<?php echo $form->textField($transaction,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'organization_id'); ?>
		<?php echo $form->textField($transaction,'organization_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'amount'); ?>
		<?php echo $form->textField($transaction,'amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'tax'); ?>
		<?php echo $form->textField($transaction,'tax',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'date'); ?>
		<?php echo $form->textField($transaction,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'create_time'); ?>
		<?php echo $form->textField($transaction,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'update_time'); ?>
		<?php echo $form->textField($transaction,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'created_by'); ?>
		<?php echo $form->textField($transaction,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($transaction,'updated_by'); ?>
		<?php echo $form->textField($transaction,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->