<?php
/* @var $this ProfileController */
/* @var $model TblProfile */

$this->breadcrumbs=array(
	'Tbl Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblProfile', 'url'=>array('index')),
	array('label'=>'Create TblProfile', 'url'=>array('create')),
	array('label'=>'View TblProfile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblProfile', 'url'=>array('admin')),
);
?>

<h1>Update TblProfile <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>