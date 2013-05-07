<?php
/* @var $this LineItemController */
/* @var $line_item LineItem */
$form = new CActiveForm;
if($asset = $line_item->asset){
	$ingredient = $asset->ingredient;// --- We have an asset! 
} else {
	// --- No asset created yet
	$asset = new Asset;
	if($ingredient = $line_item->guessIngredient()){
		$asset->ingredient_id = $ingredient->id;
	}
}
?>

<tr>
	<?php echo $form->errorSummary($asset); ?>
</tr>

<tr class="line-item-asset">
	<td>
		<?php echo $line_item->quantity; ?> <?php echo $line_item->name; ?>(s)
		<span class="ingredient-name">
		<?php if($ingredient){ 
			echo $ingredient->name; 
		} else {
			echo '<a class="open-search-ingredients-dialog">No ingredient</a>'; 
		} ?>
		</span>
		<?php echo $form->hiddenField($asset,'ingredient_id'); ?>
	</td>


	<td>
		<?php echo $form->textField($asset,'ingredient_quantity'); ?>
		<?php echo $form->error($asset,'ingredient_quantity'); ?>
		<?php echo $form->dropDownList($asset,'ingredient_unit',SbLib::getUnitsOfMeasurement()); ?>
		<?php echo $form->error($asset,'ingredient_unit'); ?>
	</td>
</tr>