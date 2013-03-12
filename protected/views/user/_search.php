<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($user,'id'); ?>
		<?php echo $form->textField($user,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'first_name'); ?>
		<?php echo $form->textField($user,'first_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'last_name'); ?>
		<?php echo $form->textField($user,'last_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'email'); ?>
		<?php echo $form->textField($user,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'username'); ?>
		<?php echo $form->textField($user,'username',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'create_time'); ?>
		<?php echo $form->textField($user,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'update_time'); ?>
		<?php echo $form->textField($user,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'created_by'); ?>
		<?php echo $form->textField($user,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user,'updated_by'); ?>
		<?php echo $form->textField($user,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->