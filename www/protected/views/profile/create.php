<?php
/* @var $this ProfileController */
/* @var $model TblProfile */

$this->breadcrumbs=array(
	'Tbl Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblProfile', 'url'=>array('index')),
	array('label'=>'Manage TblProfile', 'url'=>array('admin')),
);
?>

<h1>Create TblProfile</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>