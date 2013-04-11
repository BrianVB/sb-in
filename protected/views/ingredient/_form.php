<?php
/* @var $this IngredientController */
/* @var $ingredient Ingredient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingredient-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($ingredient); ?>

	<div class="row">
		<?php echo $form->labelEx($ingredient,'name'); ?>
		<?php echo $form->textField($ingredient,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($ingredient,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ingredient,'type'); ?>
		<?php 
		echo $form->dropDownList(
			$ingredient,
			'type',
			$ingredient->getTypeList(),
			array(
				'empty'=>'Choose one',
			)
		);
		?>
		<?php echo $form->error($ingredient,'type'); ?>
	</div>	

	<div id="hop-form" class="subtype-form" <?php if($ingredient->type != Ingredient::TYPE_HOP){ echo 'style="display:none;"'; } ?>>
		<?php $this->renderPartial('_hop_subform', array('hop'=>$hop));	?>
	</div>

	<div id="grain-form" class="subtype-form" <?php if($ingredient->type != Ingredient::TYPE_GRAIN){ echo 'style="display:none;"'; } ?>>
		<?php $this->renderPartial('_grain_subform', array('grain'=>$grain)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($ingredient->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript('settings-script', '
    $("body").on("change","#Ingredient_type",function(){
        $(".subtype-form").hide();
        if($(this).val() == '.Ingredient::TYPE_GRAIN.'){
        	$("#grain-form").show();
        } else if($(this).val() == '.Ingredient::TYPE_HOP.') {
        	$("#hop-form").show();
        }
    });'
);
?>