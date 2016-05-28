<?php

class TpsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
			//	'users'=>array('*'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user kto perform 'create' and 'update' actions
				'actions'=>array('create','update','cetak'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model2=new Admin;
		$model=new Tps;
		$mod=Pemilihan::model()->getCurrentPemilihan();

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation(array($model2,$model));

		if(isset($_POST['Tps'],$_POST['Admin']))
		{
			if($_POST['Admin']['password']===$_POST['Admin']['confirm']){
			$model2->attributes=$_POST['Admin'];
			$model2->id_level=2;
			
			if($model2->save()){
			$id_admin=Admin::model()->getIdAdmin($model2->username,$model2->password);
			
			$model->attributes=$_POST['Tps'];
			$model->id_admin=$id_admin;
			
			if($model->save()){
			Tps::model()->setSave($model->id_tps,$mod['id_pemilihan']);
			 Yii::app()->user->setFlash('create','Data '.$model->nama_tps.' Berhasil Ditambahkan.');
				$this->redirect(array('view','id'=>$model->id_tps));
			}
			
			}
			}else{
				Yii::app()->user->setFlash('error','Harap periksa password anda.');
			}
		}

		$this->render('create',array(
			'model'=>$model,'model2'=>$model2
		));
	}

	public function actionCetak()
    {
        $i=0;
        $daftarku=$_POST['daftarku'];
        foreach ($daftarku as $nomor=>$nilai)
        {
			$i++;
			$model=$this->loadModel($nilai);
            Tps::model()->deleteByPk($nilai);			
        }
		Yii::app()->user->setFlash('delete', $i.' Record  Berhasil Dihapus.');
		$this->redirect('admin');
    }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model3=new Admin;
		$model=$this->loadModel($id);
		$model2=Admin::model()->findByPk($model["id_admin"]);
		// Uncomment the following line if AJAX() validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Tps'],$_POST['Admin']))
		{
		if($_POST['Admin']['pwd_lama']===$model2["password"]){
			if($_POST['Admin']['password']===$_POST['Admin']['confirm']){
			$model2->attributes=$_POST['Admin'];
			$model->attributes=$_POST['Tps'];
			if($model2->save()){
			
			$model->attributes=$_POST['Tps'];
			
			
			if($model->save()){
				Yii::app()->user->setFlash('update','Data '.$model["nama_tps"].' Berhasil Diupdate.');
				$this->redirect(array('view','id'=>$model->id_tps));
			}
			
			}
		}else{
			Yii::app()->user->setFlash('error',' password anda tidak sama.');
		}
		
		}else{
			Yii::app()->user->setFlash('wrong_pwd','Harap periksa password lama anda.');
		}
	}
		$this->render('update',array(
			'model'=>$model,'model2'=>$model2,'model3'=>$model3
		));
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tps');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tps('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tps']))
			$model->attributes=$_GET['Tps'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tps the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tps::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tps $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tps-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
