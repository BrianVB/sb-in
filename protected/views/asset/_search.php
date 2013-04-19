<?php
/* @var $this AssetController */
/* @var $asset Asset */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($asset,'id'); ?>
		<?php echo $form->textField($asset,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'name'); ?>
		<?php echo $form->textField($asset,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'ingredient_id'); ?>
		<?php echo $form->textField($asset,'ingredient_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'ingredient_quantity'); ?>
		<?php echo $form->textField($asset,'ingredient_quantity',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'ingredient_unit'); ?>
		<?php echo $form->textField($asset,'ingredient_unit',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'create_time'); ?>
		<?php echo $form->textField($asset,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'update_time'); ?>
		<?php echo $form->textField($asset,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'created_by'); ?>
		<?php echo $form->textField($asset,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($asset,'updated_by'); ?>
		<?php echo $form->textField($asset,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->