<?php

class SiteController extends Controller
{

    public $layout='//layouts/column2';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        //echo 345;
        //echo $wer['123'] + 2;
        //echo 123;
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
        //$value=$cookies[$name]->value; // reads a cookie value
        //unset($cookies[$name]);  // removes a cookie

		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    /**
     * Displays the order page
     */
    public function actionOrder()
    {
        $model = new OrderForm;
        $form = new CForm('application.views.site.orderForm', $model);
        if($form->submitted('order') && $form->validate())
            $this->redirect(array('site/index'));
        else
            $this->render('order', array('form'=>$form));
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

    public function actionProfile()
    {
        YiiBase::beginProfile(1);
        Yii::app()->user->setFlash('infomsg',"You now editing profile");

        $model = TblProfile::model()->with('photos')->findByAttributes(array('user_id' => Yii::app()->user->getId()));
        if (!$model) {
            $model = new TblProfile();
        }
        $model->setScenario('create');

        MyClass::dump($model);

        $img_add = new TblProfilePhotos();

        // uncomment the following code to enable ajax-based validation
        if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-profile-profile-form') {
            $model->setScenario('ajax');
            echo CActiveForm::validate($model);
            Yii::app()->end();
        } elseif(isset($_POST['TblProfile'])) {
            //MyClass::dump($_FILES); exit();
            $model->attributes = $_POST['TblProfile'];
            $model->setAttribute('user_id', Yii::app()->user->getId());

            if($model->validate())
            {
                // form inputs are valid, do something here
                $model->save();
            }

            if ($_FILES['images']) {
                $images = CUploadedFile::getInstancesByName('images');

                foreach ($images as $img => $pic) {
                    if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/assets/files/'.$pic->name)) {
                        $img_add = new TblProfilePhotos();
                        $img_add->setAttribute('image', $pic);
                        $img_add->setAttribute('name', $pic->name); //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        $img_add->setAttribute('profile_id', $model->id); // this links your picture model to the main model (like your user, or profile model)
                        if($img_add->validate()){
                            $img_add->save(); // DONE
                        } else {
                            break;
                        }
                    }
                }

                /* вариант напрямик
                $builder=Yii::app()->db->schema->commandBuilder;
                $command=$builder->createMultipleInsertCommand('tbl_user_photos',
                    array_map(function($arr){
                        return array('name' => $arr, 'profile_id' => $model->attributes->id);
                    }, $_FILES['TblProfile']['name']['photos'])
                );
                $command->execute();
                */
            }
        }
        YiiBase::endProfile(1);

        $this->render('profile',array('model'=>$model, 'photosModel'=>isset($img_add) ? $img_add : null));
    }

    public function actionPosts()
    {
        //$post = TblPost::model()->findByPk(1);
        //$author = $post->categories;
        // print_r($author);

        //$posts = TblPost::model()->with(array('author.profile', 'categories'=>array('together' => false)));
        $count = TblPost::model()->with(array('author.profile', 'categories'=>array('together' => false)))->count();

        //MyClass::dump($posts);
        //$count = TblPost::model()->with('categoryCount')->findAll();


        $criteria = new CDbCriteria();
        //$criteria->select = 'author.name as author_name';
        $criteria->with[] = 'author.profile';
        $criteria->with['categories'] = array('together' => false);

        $pages=new CPagination($count);
        $pages->pageSize=2;
        //$pages->applyLimit($criteria);

        $sort=new CSort;
        $sort->modelClass='TblPost';
        $sort->attributes=array('*');
        $sort->attributes['author_username'] = array(
            'asc'=>'author.username',
            'desc'=>'author.username DESC',
        );
        $sort->separators=array(',','-');
        $sort->applyOrder($criteria);


        $dataProvider = new CActiveDataProvider(TblPost::model(),
            array(
                // можно передать $pages
                'pagination'=>array(
                    'pageSize'=>3,
                    'pageVar'=>'page',
                ),
                'sort'=>$sort
            )
        );
        $dataProvider->criteria = $criteria;

        $model = TblPost::model()->setDbCriteria($criteria);

        $this->render('posts',array(
                'pages'=>$pages,
                'dataProvider'=>$dataProvider,
                'model'=>$model
            )
        );
    }

    public function actionPostForm()
    {
        $model=new TblPost;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-post-postForm-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['TblPost']))
        {
            $model->attributes=$_POST['TblPost'];
            $model->setAttribute('author_id', Yii::app()->user->id);
            if($model->validate())
            {
                $model->save();
            }
        }
        $this->render('postForm',array('model'=>$model));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}