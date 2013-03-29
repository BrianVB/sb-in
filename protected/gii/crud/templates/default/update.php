<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $<?php echo $this->getModelVariableName(); ?> <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$".$this->getModelVariableName()."->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Update',
);\n";
?>

$this->menu=array(
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>s', 'url'=>array('index')),
);
?>

<h1>Update <?php echo $this->modelClass." <?php echo \$".$this->getModelVariableName()."->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('".$this->getModelVariableName()."'=>\$".$this->getModelVariableName().")); ?>"; ?>