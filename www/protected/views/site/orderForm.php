<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 22.08.15
 * Time: 16:38
 */

return array(
    'title'=>'Группа полей',

    'elements'=>array(
        'date'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'quantity'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'delivery'=>array(
            'type'=>'dropdownlist',
            'items'=>Delivery::model()->getDeliveryOptions(),
            'prompt'=>'Выберите значение:',
        ),
        '<hr>',
    ),

    'buttons'=>array(
        'order'=>array(
            'type'=>'submit',
            'label'=>'Submit',
        ),
    ),
);