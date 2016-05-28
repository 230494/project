<?php

class KandidatController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','cetak'),
					'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			//	'users'=>array('admin'),
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
		$data=Kandidat::model()->getPemilihanKandidat($id);
		$this->render('view',array(
			'model'=>$this->loadModel($id),'data'=>$data
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$mod=Pemilihan::model()->getCurrentPemilihan();
		$model=new Kandidat;
	
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		$data=Pemilihan::model()->getCurrentPemilihan();
		if(isset($_POST['Kandidat']))
		{
			$model->attributes=$_POST['Kandidat'];
			//$model->id_pemilihan=Pemilihan::model()->getIdPemilihan();
			$img = CUploadedFile::getInstance($model, 'foto');
			
			$rnd = rand(0,9999);
			$nameImg=$rnd.'_'.$img->getName();
			$model->foto=$nameImg;
			
			if($model->save()){
				if(isset($img)){
				$path=Yii::app()->basePath . '/../images/kandidat/'.$nameImg;
				$img->saveAs($path);
				
				//utk resize gambar
                $image = Yii::app()->image->load($path);

                /* begin- utk memutar jika file asli portrait */
                $tinggi=$image->__get('height');
                $lebar=$image->__get('width');

				if($tinggi>$lebar){
                    $image->resize(600, 400)->rotate(0);
                }else{
                    $image->resize(600, 400);
                }
                              /* end- utk memutar jika file ori portrait */
                   $image->save();
                              
				}
				
				 Kandidat::model()->setSave($model->id_kandidat,$mod['id_pemilihan']);
				 Yii::app()->user->setFlash('create','Kandidat '.$model->nama_kandidat.' Berhasil Ditambahkan.');
				 $this->redirect(array('view','id'=>$model->id_kandidat));	
			}
		}

		$this->render('create',array(
			'model'=>$model,'data'=>$data
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Kandidat::model()->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$data=Kandidat::model()->getPemilihanKandidat($id);
		
		
		if(isset($_POST['Kandidat']))
		{	
			$model->attributes=$_POST['Kandidat'];
			$temp=$_POST['Kandidat']['foto_lama'];
			
			 $uploadedFile = CUploadedFile::getInstance($model,'foto');
			
			if (isset($uploadedFile)) {
					 $uploadedFile->saveAs(Yii::app()->basePath .'/../images/kandidat/'.$uploadedFile->name); //cek kalo kosong atau filenya sama
					 $model->foto=$uploadedFile->name;
					unlink(Yii::app()->basePath . '/../images/kandidat/'.$temp);
			}else{
				
				$model->foto=$temp;
			}
			
			
			if($model->save()){
				Yii::app()->user->setFlash('update','Kandidat '.$model->nama_kandidat.' Berhasil Diupdate.');
				$this->redirect(array('view','id'=>$model->id_kandidat));
			}else{
			Yii::app()->user->setFlash('update_gagal','Kandidat '.$model->nama_kandidat.' Gagal Diupdate.');
			}
		}

		$this->render('update',array(
			'model'=>$model,'data'=>$data
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
            Kandidat::model()->deleteByPk($nilai);
			if(!empty($model->foto))
				unlink(Yii::app()->basePath . '/../images/kandidat/'.$model->foto);
        }
		Yii::app()->user->setFlash('delete',$i.' Record Berhasil Dihapus.');
		$this->redirect('admin');
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		$this->loadModel($id)->delete();
		Kandidat::model()->deleteAllKandidat($id);
		unlink(Yii::app()->basePath . '/../images/kandidat/'.$model->foto);
	
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
			Yii::app()->user->setFlash('delete','Kandidat '.$model->nama_kandidat.' Berhasil Dihapus.');
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Kandidat');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kandidat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kandidat']))
			$model->attributes=$_GET['Kandidat'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kandidat the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kandidat::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kandidat $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kandidat-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
