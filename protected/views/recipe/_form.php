<?php
/* @var $this RecipeController */
/* @var $recipe Recipe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recipe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($recipe); ?>

	<div class="row">
		<?php echo $form->labelEx($recipe,'name'); ?>
		<?php echo $form->textField($recipe,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($recipe,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($recipe,'days_in_primary'); ?>
		<?php echo $form->textField($recipe,'days_in_primary'); ?>
		<?php echo $form->error($recipe,'days_in_primary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($recipe,'days_in_secondary'); ?>
		<?php echo $form->textField($recipe,'days_in_secondary'); ?>
		<?php echo $form->error($recipe,'days_in_secondary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($recipe,'days_in_tertiary'); ?>
		<?php echo $form->textField($recipe,'days_in_tertiary'); ?>
		<?php echo $form->error($recipe,'days_in_tertiary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($recipe,'starting_gravity'); ?>
		<?php echo $form->textField($recipe,'starting_gravity',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($recipe,'starting_gravity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($recipe,'ending_gravity'); ?>
		<?php echo $form->textField($recipe,'ending_gravity',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($recipe,'ending_gravity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($recipe,'process'); ?>
		<?php echo $form->textArea($recipe,'process',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($recipe,'process'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($recipe->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->