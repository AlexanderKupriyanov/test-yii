<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        //echo Yii::app()->controller->module->postPerPage;
		$this->render('index');
	}

    function actionEvent() {
        $service = new Service();
        $myclass = new MyClass();
        $myclass->onRun = array($service, 'comment');
        $myclass->run();
    }
}