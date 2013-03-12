<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
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
	 * Displays the login page
	 */
	public function actionLogin()
	{
		// --- Can't log in if they're already logged in so redirect
		if(!Yii::app()->user->isGuest){
			$this->redirect(array('site/index'));
		}

		$user=new User('login');

		// collect user input data
		if(isset($_POST['User']))
		{
			$user->attributes=$_POST['User'];
			// validate user input and redirect to the previous page if valid
			if($user->validate() && $user->login()){
				$returnUrl = (isset($_POST['returnUrl'])) ? $_POST['returnUrl'] : Yii::app()->user->returnUrl;
				$this->redirect($returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('user'=>$user));
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