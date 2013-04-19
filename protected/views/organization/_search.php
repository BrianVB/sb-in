<?php
/* @var $this OrganizationController */
/* @var $organization Organization */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($organization,'id'); ?>
		<?php echo $form->textField($organization,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($organization,'name'); ?>
		<?php echo $form->textField($organization,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($organization,'create_time'); ?>
		<?php echo $form->textField($organization,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($organization,'update_time'); ?>
		<?php echo $form->textField($organization,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($organization,'created_by'); ?>
		<?php echo $form->textField($organization,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($organization,'updated_by'); ?>
		<?php echo $form->textField($organization,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->