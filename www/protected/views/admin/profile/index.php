<?php
/* @var $this ProfileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Profiles',
);

$this->menu=array(
	array('label'=>'Create TblProfile', 'url'=>array('create')),
	array('label'=>'Manage TblProfile', 'url'=>array('admin')),
);
?>

<h1>Tbl Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
