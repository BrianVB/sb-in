<?php
/* @var $this IngredientController */
/* @var $ingredient Ingredient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingredient-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($ingredient); ?>

	<div class="row">
		<?php echo $form->labelEx($ingredient,'name'); ?>
		<?php echo $form->textField($ingredient,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($ingredient,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ingredient,'unit_measurement'); ?>
		<?php echo $form->textField($ingredient,'unit_measurement',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($ingredient,'unit_measurement'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($ingredient->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->