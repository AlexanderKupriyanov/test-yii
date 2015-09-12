<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 22.08.15
 * Time: 16:38
 */

return array(
    'title'=>'ログインの証明となる情報を入力してください',

    'elements'=>array(
        'date'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        '<hr>',
        'quantity'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'delivery'=>array(
            'type'=>'dropdownlist',
            'items'=>Delivery::model()->getDeliveryOptions(),
            'prompt'=>'Выберите значение:',
        ),
    ),

    'buttons'=>array(
        'submit'=>array(
            'type'=>'submit',
            'label'=>'Submit',
        ),
    ),
);