<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaction-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($transaction); ?>

	<div class="row">
		<?php echo $form->labelEx($transaction,'organization_id'); ?>
		<?php echo $form->dropDownList(
			$transaction,
			'organization_id',
			CHtml::listData(Organization::model()->findAll(array('order'=>'name')), 'id','name'),
			array(
				'empty'=>'Choose an Organization',
			)
		); ?>
		<?php echo $form->error($transaction,'organization_id'); ?>
	</div>

	<table id="transaction-line-items">
		<thead>
			<th>Quantity</th>
			<th>Item</th>
			<th>Price</th>
			<th><?php echo CHtml::ajaxButton('Add', 
				array('/transaction/addLineItem'),
				array(
					'data'=>'js:{ index: line_item_index }',
					'success'=>'js:function(response){
						$(response).appendTo("#transaction-line-items tbody");
						line_item_index++;
					}'
				)
			); ?></th>
		</thead>
		<tbody>
		<?php foreach($line_items as $index=>$line_item): ?>
			<?php $this->renderPartial('_line_item_subform', array('line_item'=>$line_item,'index'=>$index)); ?>
		<?php endforeach; ?>
		</tbody>
	</table>

	<div class="row">
		<?php echo $form->labelEx($transaction,'amount'); ?>
		<?php echo $form->textField($transaction,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($transaction,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($transaction,'tax'); ?>
		<?php echo $form->textField($transaction,'tax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($transaction,'tax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($transaction,'date'); ?>
		<?php echo $form->textField($transaction,'date'); ?>
		<?php echo $form->error($transaction,'date'); ?>
	</div>

	<div class="row buttons">
		<?php if($transaction->id){ $form->hiddenField($transaction,'id'); } ?>
		<?php echo CHtml::submitButton($transaction->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScript(
	'line-item-name-search',
	'$("body").on("keyup.line-item-search", ".line-item-search", function(){
		$(this).autocomplete({
			"minLength":"2",
			"select":function(event, ui){
				$("#LineItem_0_price").val(ui.item.price);
			},
			"source":"/transaction/ajaxGuessLineItem"
		});
	});',
	CClientScript::POS_READY
);

?>