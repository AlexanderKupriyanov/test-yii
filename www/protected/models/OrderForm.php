<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class OrderForm extends CFormModel
{
	public $date;
	public $quantity;
    public $delivery;
//sq01
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('date, quantity, delivery', 'required'),
		);
	}
//sq 02
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'date'=>'Дата доставки',
            'quantity'=>'Количество',
            'delivery'=>'Способ доставки'
		);
	}
}
