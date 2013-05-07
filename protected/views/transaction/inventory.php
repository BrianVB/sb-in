<?php
/* @var $this TransactionController */
/* @var $transaction Transaction */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Transactions', 'url'=>array('index')),
);

$index = 0;
?>

<h1>Manage Inventory</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-inveotory-form',
)); ?>
	<table id="transaction-inventory">
		<thead>
			<th>Transaction Details</th>
			<th>Inventory</th>
		</thead>
		<tbody>
		<?php foreach($line_items as $line_item): ?>
			<?php echo $this->renderPartial('_asset_subform', array('line_item'=>$line_item, 'index'=>$index)); ?>
		<?php $index++; endforeach; ?>
		</tbody>
	</table>
<?php $this->endWidget(); ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'search-ingredients-dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Search Ingredients',
        'autoOpen'=>false,
    ),
)); ?>
<p>We couldn't match this to an ingredient, start typing in the box below to select one.</p>
<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
	'name'=>'ingredient_search',
    'sourceUrl'=>array('/transaction/ajaxGuessIngredient'),
    'options'=>array(
        'minLength'=>'2',
        'select'=>'js:function(event, ui){
        	$("#Asset_ingredient_id").eq(link_index).val(ui.item.id);
        	console.log(event);
        }'
    ),
)); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php
Yii::app()->clientScript->registerScript(
	'open-ingredient-search-dialog',
	'var link_index;
	$("body").on("click", ".open-search-ingredients-dialog", function(){
		link_index = $(".open-search-ingredients-dialog").index($(this));
		console.log(link_index);
		$("#search-ingredients-dialog").dialog("open");
	});',
	CClientScript::POS_READY
);
?>