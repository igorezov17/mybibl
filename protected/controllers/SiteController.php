<?php

class SiteController extends Controller
{
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
	
	
	
	
	
	
	
	
	
	public function actionLogin()
	{
		$model=new LoginForm;
		if(isset($_POST['LoginForm']))
		{
			// получаем данные от пользователя
			$model->attributes=$_POST['LoginForm'];
			// проверяем полученные данные и, если результат проверки положительный,
			// перенаправляем пользователя на предыдущую страницу
			if($model->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// рендерим представление
		$this->render('login',array('model'=>$model));
	}
	
	
	public function actionRegister()
	{
		$model = new RegisterForm;

		if (isset($_POST['RegisterForm']))
		{
			$model->attributes = $_POST['RegisterForm'];

			if ($model->validate()) {
				$user = new Users;
				$user->email = $model->email;
				$user->public_key = md5($model->email+'+'+$model->password);
				$user->save();

				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('register', array('model' => $model));
	}

	protected $loginModel = null;
	
	protected function beforeAction() {
		$this->loginModel = new LoginForm;

		if (isset($_POST['LoginForm']))
		{
			$this->loginModel->attributes = $_POST['LoginForm'];

			if ($this->loginModel->validate()) {
				$ide = $this->loginModel->getIde();
				if (!Yii::app()->user->login($ide, 3600*24*7)) {
					var_dump($ide);
				}
			} else {
				$this->actionError();
			}
		}

		return true;
	}

	public function actionIndex()
	{
		$ret = array();

		if (Yii::app()->user->isGuest) {
			$login = new LoginForm;
			$ret['login'] = $login;
		}

		$books = Books::model()->findAll();
		$ret['books'] = $books;

		$this->render('index', $ret);
	}
	
	public function actionBooks()
	{
		echo Books::model()->findByPk(1)->name;
		
	}
}