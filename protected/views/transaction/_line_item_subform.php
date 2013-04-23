<?php
/* @var $this LineItemController */
/* @var $line_item LineItem */
$form = new CActiveForm;
?>

<tr>
	<?php echo $form->errorSummary($line_item); ?>
</tr>

<tr class="line-item">
	<td>
		<?php echo $form->textField($line_item,'quantity',array('name'=>'LineItem['.$index.'][quantity]')); ?>
		<?php echo $form->error($line_item,'quantity',array('name'=>'LineItem['.$index.'][quantity]')); ?>
	</td>

	<td>
		<?php echo $form->dropDownList(
			$line_item,
			'asset_id',
			CHtml::listData(Asset::model()->findAll(array('order'=>'name')),'id','fullName'),
			array(
				'empty'=>'Select an item',
				'name'=>'LineItem['.$index.'][asset_id]',
			)
		); ?>
		<?php echo $form->error($line_item,'asset_id'); ?>
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