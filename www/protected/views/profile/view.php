<?php
/* @var $this ProfileController */
/* @var $model TblProfile */

$this->breadcrumbs=array(
	'Tbl Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblProfile', 'url'=>array('index')),
	array('label'=>'Create TblProfile', 'url'=>array('create')),
	array('label'=>'Update TblProfile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblProfile', 'url'=>array('admin')),
);
?>

<h1>View TblProfile #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'gender',
		'website',
	),
)); ?>
