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

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		unset(Yii::app()->session['nim'],Yii::app()->session['id_pemilih'],Yii::app()->session['id_tps'], Yii::app()->session['id_fakultas'], Yii::app()->session['id_pemilihan']);
		
		$model=Pemilihan::model()->getCurrentPemilihan();
		Yii::app()->session->add('nama_pemilihan', $model['nama_pemilihan']);
		Yii::app()->session->add('bilik_ke',1);
		$pemilih=Pemilih::model()->getPemilihSedangMemilih(Yii::app()->session['bilik_ke']);
	
		Yii::app()->session->add('id_pemilih',$pemilih['id_pemilih']);
		Yii::app()->session->add('id_tps',$pemilih['id_tps']);
		Yii::app()->session->add('id_fakultas',$pemilih['id_fakultas']);
		Yii::app()->session->add('id_pemilihan',$pemilih['id_pemilihan']);
		Yii::app()->session->add('nim',$pemilih['nim']);
		
		$this->render('index', array('model'=>$model));
	}
	
	
	public function actionIndex2()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		unset(Yii::app()->session['nim2'],Yii::app()->session['id_pemilih2'], Yii::app()->session['id_tps'], Yii::app()->session['id_fakultas'], Yii::app()->session['id_pemilihan'],Yii::app()->session['id_kandidat']);
		$model=Pemilihan::model()->getCurrentPemilihan();
		Yii::app()->session->add('nama_pemilihan', $model['nama_pemilihan']);
		Yii::app()->session->add('bilik_ke2',2);
		$pemilih=Pemilih::model()->getPemilihSedangMemilih(Yii::app()->session['bilik_ke2']);
	
			Yii::app()->session->add('id_pemilih2',$pemilih['id_pemilih']);
			Yii::app()->session->add('nim2',$pemilih['nim']);
			Yii::app()->session->add('id_tps',$pemilih['id_tps']);
			Yii::app()->session->add('id_fakultas',$pemilih['id_fakultas']);
			Yii::app()->session->add('id_pemilihan',$pemilih['id_pemilihan']);
		
		$this->render('index2', array('model'=>$model));
	}
	
	
	public function actionExtend_time(){
		
		$this->render('extendTime');
	}
	
	public function actionExtend_time2(){
	
		$this->render('extendTime2');
	}
	
	
	public function actionTables()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$model=Pemilihan::model()->getCurrentPemilihan();
		$this->render('tables');
	}
	
	public function actionConfirm($id){
		
		$dat=Kandidat::model()->findByPk($id);
		$model=Pemilihan::model()->getCurrentPemilihan();
		$this->render('confirm', array('dat'=>$dat,'model'=>$model));
	}
	
	public function actionConfirm2($id){
		
		$dat=Kandidat::model()->findByPk($id);
		$model=Pemilihan::model()->getCurrentPemilihan();
		$this->render('confirm2', array('dat'=>$dat,'model'=>$model));
	}

	public function actionCount($id){
		if(Kandidat::model()->berikanSuaraKandidat($id,1)){
			$data1=Kandidat::model()->findByPk($id);
			$this->render('finish', array('data1'=>$data1));
		}else{
			$this->redirect('index');
		}
	
	}
	
	public function actionCount2($id){
		if(Kandidat::model()->berikanSuaraKandidat($id,2)){
			$data1=Kandidat::model()->findByPk($id);
			$this->render('finish2', array('data1'=>$data1));
		}else{
			$this->redirect('index2');
		}
	
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
	
	public function actionDetail($id){
	    $model=Kandidat::model()->getIdKandidat($id);
       	echo $this->renderPartial('_detail', array('data'=>$model));
	}
	/**
	 * Displays the contact page
	 */
	/*public function actionContact()
	{
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
	}*/

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
	 $model=Pemilihan::model()->getCurrentPemilihan(); 
	  Yii::app()->session->add('nama_pemilihan', $model['nama_pemilihan']);
		
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
			if($model->validate() && $model->login()){
				$user =new EWebUser;
				if($user->getLevel()==1){
					$this->redirect(Yii::app()->createUrl('pusat') );
				}else if($user->getLevel()==2){
					$this->redirect(Yii::app()->createUrl('tpsadmin') );
				}else{
					$this->redirect(Yii::app()->user->returnUrl );
				}
				
				}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('login');
	}
}