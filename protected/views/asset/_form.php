<?php
/* @var $this AssetController */
/* @var $asset Asset */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asset-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($asset); ?>

	<div class="row">
		<?php echo $form->labelEx($asset,'name'); ?>
		<?php echo $form->textField($asset,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($asset,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($asset,'ingredient_id'); ?>
		<?php echo $form->dropDownList($asset,'ingredient_id',CHtml::listData($ingredients, 'id', 'fullName'), array('empty'=>'Choose Ingredient')); ?>
		<?php echo $form->error($asset,'ingredient_id'); ?>
	</div>

	<div id="ingredient-quantity" style="display:none;">
		<div class="row">
			<?php echo $form->labelEx($asset,'ingredient_quantity'); ?>
			<?php echo $form->textField($asset,'ingredient_quantity'); ?>
			<?php echo $form->error($asset,'ingredient_quantity'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($asset,'ingredient_unit'); ?>
			<?php echo $form->dropDownList($asset,'ingredient_unit',SbLib::getUnitsOfMeasurement()); ?>
			<?php echo $form->error($asset,'ingredient_unit'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($asset->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript(
	'show-hide-asset-ingredient',
	'$("body").on("change", "#Asset_ingredient_id", function(){
		if($(this).val() == ""){
			$("#ingredient-quantity").hide();
		} else {
			$("#ingredient-quantity").show();
		}
	});',
	CClientScript::POS_READY
);
?>