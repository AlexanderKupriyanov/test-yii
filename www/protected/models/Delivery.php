<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class Delivery extends CActiveRecord
{
    public function tableName()
    {
        return 'tbl_user';
    }

	public function getDeliveryOptions () {
        return array (
            '1' => 'EMS',
            '2' => 'UPS'
        );
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
