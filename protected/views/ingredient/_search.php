<?php
/* @var $this IngredientController */
/* @var $ingredient Ingredient */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($ingredient,'id'); ?>
		<?php echo $form->textField($ingredient,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($ingredient,'name'); ?>
		<?php echo $form->textField($ingredient,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($ingredient,'unit_measurement'); ?>
		<?php echo $form->textField($ingredient,'unit_measurement',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($ingredient,'create_time'); ?>
		<?php echo $form->textField($ingredient,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($ingredient,'update_time'); ?>
		<?php echo $form->textField($ingredient,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($ingredient,'created_by'); ?>
		<?php echo $form->textField($ingredient,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($ingredient,'updated_by'); ?>
		<?php echo $form->textField($ingredient,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->