<?php
/* @var $this OrganizationController */
/* @var $organization Organization */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'organization-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($organization); ?>

	<div class="row">
		<?php echo $form->labelEx($organization,'name'); ?>
		<?php echo $form->textField($organization,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($organization,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($organization,'update_by'); ?>
		<?php echo $form->textField($organization,'update_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($organization,'update_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($organization->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->