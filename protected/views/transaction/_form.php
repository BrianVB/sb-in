<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaction-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($transaction); ?>

	<div class="row">
		<?php echo $form->labelEx($transaction,'organization_id'); ?>
		<?php echo $form->textField($transaction,'organization_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($transaction,'organization_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($transaction,'amount'); ?>
		<?php echo $form->textField($transaction,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($transaction,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($transaction,'tax'); ?>
		<?php echo $form->textField($transaction,'tax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($transaction,'tax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($transaction,'date'); ?>
		<?php echo $form->textField($transaction,'date'); ?>
		<?php echo $form->error($transaction,'date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($transaction->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->