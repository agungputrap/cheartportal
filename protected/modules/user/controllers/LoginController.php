<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		var_dump(Yii::app()->controller->module->returnUrl);
		var_dump(Yii::app()->user->returnUrl);
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					Yii::app()->session['status'] = "masuk woi";
					if (Yii::app()->user->returnUrl=='/index.php') {
						$this->redirect(Yii::app()->controller->module->returnUrl);
					}
					else {
						$this->redirect(Yii::app()->user->returnUrl);
					}
				}
			}
			// display the login form
			//$this->layout="login_layout";
			$this->render('/user/login2',array('model'=>$model));

		} else
			//$this->redirect(Yii::app()->controller->module->returnUrl);
		$this->redirect(Yii::app()->user->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}