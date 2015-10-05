<?php
/* @var $this TblProfileController */
/* @var $model TblProfile */
/* @var $form CActiveForm */
?>
Посты юзера:

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'pager'=>array('class'=>'CListPager', 'promptText'=>123, 'pageTextFormat'=>'стр. %s'),
    'filter'=>$model,
    //'enablePagination' => false,
    'columns'=>array(
        'title',          // display the 'title' attribute
        'categories.name',  // display the 'name' attribute of the 'category' relation
        'content:html',   // display the 'content' attribute as purified HTML
        'author.username',
        array(            // display 'create_time' using an expression
            'name'=>'create_time',
            'value'=>'date("M j, Y", strtotime($data->create_time))',
        ),
        array(            // display 'author.username' using an expression
            //'class'=>'CDataColumn',
            'name'=>'author_username',
            'value'=>'$data->author->username',
            'sortable'=>true
        ),
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CCheckBoxColumn',
            'selectableRows'=>2,
            'htmlOptions'=>array('style'=>'width: 20px','class'=>'chandran'),
        ),
    ),
));

// display pagination
$this->widget('CLinkPager', array(
    'pages' => $pages,
));
?>