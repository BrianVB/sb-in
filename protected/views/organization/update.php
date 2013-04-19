<?php
/* @var $this OrganizationController */
/* @var $organization Organization */

$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	$organization->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Organization', 'url'=>array('create')),
	array('label'=>'Manage Organizations', 'url'=>array('index')),
);
?>

<h1>Update Organization <?php echo $organization->id; ?></h1>

<?php echo $this->renderPartial('_form', array('organization'=>$organization)); ?>