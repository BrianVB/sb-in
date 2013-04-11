<?php
/* @var $this HopController */
/* @var $hop Hop */
$form = new CActiveForm;
?>

	<?php echo $form->errorSummary($hop); ?>

	<div class="row">
		<?php echo $form->labelEx($hop,'alpha'); ?>
		<?php echo $form->textField($hop,'alpha',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($hop,'alpha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hop,'beta'); ?>
		<?php echo $form->textField($hop,'beta',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($hop,'beta'); ?>
	</div>