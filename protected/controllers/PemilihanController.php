<?php

class PemilihanController extends Controller
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
				'actions'=>array('index','view','mode'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','formtime','cetak','tambahwaktu'),
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
	
	
	public function actionMode($id=-1){
		if($id==-1){
			Yii::app()->db->createCommand('update pemilihan set status=0   ')->query();	
			Yii::app()->user->setFlash('non-aktif','Semua Pemilihan Tidak Aktif.');
			 unset(Yii::app()->session['id_pemilihan'],Yii::app()->session['nama_pemilihan'],Yii::app()->session['start_time'],Yii::app()->session['end_time']);
		}else {
			Yii::app()->db->createCommand('update pemilihan set status=0   ')->query();	
			Yii::app()->db->createCommand('update pemilihan set status=1  where id_pemilihan='.$id.' ')->query();
			 $model=Pemilihan::model()->getCurrentPemilihan(); 
			 unset(Yii::app()->session['id_pemilihan'],Yii::app()->session['nama_pemilihan'],Yii::app()->session['start_time'],Yii::app()->session['end_time']);
			 Yii::app()->session->add('nama_pemilihan', $model['nama_pemilihan']);
			 Yii::app()->session->add('id_pemilihan', $model['id_pemilihan']);
			 Yii::app()->session->add('start_time', $model['start_time']);
			 Yii::app()->session->add('end_time', $model['end_time']);
			
			Yii::app()->user->setFlash('aktif', $model['nama_pemilihan'].' Telah Diaktifkan.');
	}
		
		$this->redirect(array('index'));
	}
	
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pemilihan;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Pemilihan']))
		{
			$model->attributes=$_POST['Pemilihan'];
			$img = CUploadedFile::getInstance($model, 'logo');
			$rnd = rand(0,9999);
			$nameImg=$rnd.'_'.$img->getName();
			$model->logo=$nameImg;
			
			if($model->save()){
				if(isset($img)){
				$path=Yii::app()->basePath . '/../images/pemilihan/'.$nameImg;
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
				 Yii::app()->user->setFlash('create','Data '.$model->nama_pemilihan.' Berhasil Ditambahkan.');
				$this->redirect(array('view','id'=>$model->id_pemilihan));
				
			}
		}

		$this->render('create',array(
			'model'=>$model,
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
            Pemilihan::model()->deleteByPk($nilai);
			if(!empty($model->logo))
				unlink(Yii::app()->basePath . '/../images/pemilihan/'.$model->logo);
				
        }
		Yii::app()->user->setFlash('delete', $i.' Record  Berhasil Dihapus.');
		$this->redirect('admin');
    }
	
	public function actiontambahwaktu(){
		$jam=$_POST['jam'];
	//	$menit=$_POST['menit'];
		$model=Pemilihan::model()->findByPk(Yii::app()->session['id_pemilihan']);
		$end_current_time= date_create($model['end_time']);
		
		date_add($end_current_time, date_interval_create_from_date_string($jam.' hours')); 
	//	date_add($end_current_time, date_interval_create_from_date_string($menit.' minutes'));
		$waktuNow=date_format($end_current_time, 'Y-m-d H:i:s');
		$data = Yii::app()->db->createCommand('UPDATE pemilihan SET start_time ='.$waktuNow.' WHERE id_pemilihan='.Yii::app()->session['id_pemilihan'].' ');    
	
		if($data){
			 Yii::app()->user->setFlash('tambah_waktu_sukses','Waktu '.$model->nama_pemilihan.' Berhasil Ditambahkan.');
		}else{
			 Yii::app()->user->setFlash('tambah_waktu_gagal','Waktu '.$model->nama_pemilihan.' Gagal Ditambahkan.');
		}
		
		$this->redirect(array('view','id'=>$model->id_pemilihan));
	}
		
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		$temp=$model->logo;
		if(isset($_POST['Pemilihan']))
		{
				//$_POST['Pemilihan']['logo'] = $model->logo;
			$model->attributes=$_POST['Pemilihan'];
		/*	$model->jumlah_bilik=$_POST['Pemilihan']['jumlah_bilik'];
			$model->start_time=$_POST['Pemilihan']['start_time'];
			$model->end_time=$_POST['Pemilihan']['end_time'];*/
		
				
            $img=CUploadedFile::getInstance($model,'logo');
				// if($img=="")  $model->logo=$temp;
				if($model->save()){
				if(!empty($img)) { 
                              $rnd = rand(0,9999);  // generate random number between 0-9999
							$nameImg = $rnd.'_'.$img->getName();  // random number + file name
                              $model->logo = $nameImg ;
                              $model->save(); //mengirim data lokasi file foto ke mysql

                              //simpan file 
                              
                              $path=Yii::app()->basePath . '/../images/pemilihan/'.$nameImg;
                              $img->saveAs($path);  //
							  unlink(Yii::app()->basePath . '/../images/pemilihan/'.$temp);
                              //
                              //utk resize gambar
                              $image = Yii::app()->image->load($path);

                              /* begin- utk memutar jika file ori portrait */
                              $tinggi=$image->__get('height');
                              $lebar=$image->__get('width');
                              if($tinggi>$lebar)
                              {
                              $image->resize(600, 400)->rotate(0);
                              }
                              else
                              {
                              $image->resize(600, 400);
                              }
                              /* end- utk memutar jika file ori portrait */

                              $image->save();
                              
                            
                             }
                           
							 }
							  Yii::app()->user->setFlash('update','Data '.$model->nama_pemilihan.' Berhasil Diupdate.');
							   $this->redirect(array('view','id'=>$model->id_pemilihan));
                    }    
					
					$this->render('update',array(
			'model'=>$model,
		));
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
		if(!empty($model->logo))
			unlink(Yii::app()->basePath . '/../images/pemilihan/'.$model->logo);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
		Yii::app()->user->setFlash('delete','Data '.$model->nama_pemilihan.' Berhasil Dihapus.');
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pemilihan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pemilihan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pemilihan']))
			$model->attributes=$_GET['Pemilihan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pemilihan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pemilihan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pemilihan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pemilihan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
