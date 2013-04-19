<?php
/* @var $this LineItemController */
/* @var $lineitem LineItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'line-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($lineitem); ?>

	<div class="row">
		<?php echo $form->labelEx($lineitem,'transaction_id'); ?>
		<?php echo $form->textField($lineitem,'transaction_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($lineitem,'transaction_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($lineitem,'asset_id'); ?>
		<?php echo $form->textField($lineitem,'asset_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($lineitem,'asset_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($lineitem,'quantity'); ?>
		<?php echo $form->textField($lineitem,'quantity'); ?>
		<?php echo $form->error($lineitem,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($lineitem,'unit_price'); ?>
		<?php echo $form->textField($lineitem,'unit_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($lineitem,'unit_price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($lineitem->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->