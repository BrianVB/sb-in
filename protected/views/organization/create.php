<?php
/* @var $this OrganizationController */
/* @var $organization Organization */

$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Organizations', 'url'=>array('index')),
);
?>

<h1>Create Organization</h1>

<?php echo $this->renderPartial('_form', array('organization'=>$organization)); ?>