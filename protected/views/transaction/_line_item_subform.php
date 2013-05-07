<?php
/* @var $this LineItemController */
/* @var $line_item LineItem */
$form = new CActiveForm;
?>

<?php if($line_item->hasErrors()): ?>
<tr>
	<td colspan="4"><?php echo $form->errorSummary($line_item); ?></td>
</tr>
<?php endif; ?>

<tr class="line-item">
	<td>
		<?php echo $form->textField($line_item,'quantity',array('name'=>'LineItem['.$index.'][quantity]')); ?>
		<?php echo $form->error($line_item,'quantity'); ?>
	</td>

	<td>
		<?php echo $form->textField($line_item,'name',array('name'=>'LineItem['.$index.'][name]','class'=>'line-item-search')); ?>
		<?php echo $form->error($line_item,'name'); ?>
	</td>

	<td>
		<?php echo $form->textField($line_item,'unit_price',array('name'=>'LineItem['.$index.'][unit_price]')); ?>
		<?php echo $form->error($line_item,'unit_price'); ?>
	</td>

	<td class="row buttons">
		<?php echo $form->hiddenField($line_item,'id',array('name'=>'LineItem['.$index.'][id]')); ?>
		<?php echo CHtml::button(
			'Remove',
			array(
				'class'=>'remove',
				'data-id'=>($line_item->id)?:null,
			)
		); ?>
	</td>
</td>