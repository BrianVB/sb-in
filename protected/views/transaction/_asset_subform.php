<?php
/* @var $this LineItemController */
/* @var $line_item LineItem */
$form = new CActiveForm;
$asset = ($line_item->asset) ?: new Asset;
?>

<tr>
	<?php echo $form->errorSummary($asset); ?>
</tr>

<tr class="line-item-asset">
	<td>
		<?php echo $form->labelEx($asset,'name'); ?>
		<?php echo $form->textField($asset,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($asset,'name'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($asset,'ingredient_id'); ?>
		<?php echo $form->dropDownList($asset,'ingredient_id',CHtml::listData($ingredients, 'id', 'fullName'), array('empty'=>'Choose Ingredient')); ?>
		<?php echo $form->error($asset,'ingredient_id'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($asset,'ingredient_quantity'); ?>
		<?php echo $form->textField($asset,'ingredient_quantity'); ?>
		<?php echo $form->error($asset,'ingredient_quantity'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($asset,'ingredient_unit'); ?>
		<?php echo $form->dropDownList($asset,'ingredient_unit',SbLib::getUnitsOfMeasurement()); ?>
		<?php echo $form->error($asset,'ingredient_unit'); ?>
	</td>
</tr>