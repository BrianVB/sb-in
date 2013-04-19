<?php
/* @var $this IngredientController */
/* @var $grain grain */
$form = new CActiveForm;
?>
	<div class="row">
		<?php echo $form->labelEx($grain,'lovibond'); ?>
		<?php echo $form->textField($grain,'lovibond',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($grain,'lovibond'); ?>
	</div>