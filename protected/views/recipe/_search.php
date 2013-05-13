<?php
/* @var $this RecipeController */
/* @var $recipe Recipe */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($recipe,'id'); ?>
		<?php echo $form->textField($recipe,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'name'); ?>
		<?php echo $form->textField($recipe,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'days_in_primary'); ?>
		<?php echo $form->textField($recipe,'days_in_primary'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'days_in_secondary'); ?>
		<?php echo $form->textField($recipe,'days_in_secondary'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'days_in_tertiary'); ?>
		<?php echo $form->textField($recipe,'days_in_tertiary'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'starting_gravity'); ?>
		<?php echo $form->textField($recipe,'starting_gravity',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'ending_gravity'); ?>
		<?php echo $form->textField($recipe,'ending_gravity',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'process'); ?>
		<?php echo $form->textArea($recipe,'process',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'create_time'); ?>
		<?php echo $form->textField($recipe,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'update_time'); ?>
		<?php echo $form->textField($recipe,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'created_by'); ?>
		<?php echo $form->textField($recipe,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($recipe,'updated_by'); ?>
		<?php echo $form->textField($recipe,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->