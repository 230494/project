<?php

class VerifikasiController extends Controller
{
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','verify','masukbilik','keluarkanpeserta'),
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
	
	public function actionIndex(){
		$this->render('index');
	}
	
	public function actionVerify(){
	
	$nim=$_GET['nim'];
	$vis["button"]=null;
	$vis["form"]=null;
	$now = date('Y-m-d H:i:s', time());
	$mod=Pemilihan::model()->getCurrentPemilihan();
	$model = Pemilih::model()->getInfoPemilih($nim);
	
		if($now>$mod['start_time'] AND $now<$mod['end_time']){ 
			if(!empty($model)){
				if($model["status"]=='1'){
					Yii::app()->user->setFlash('verify',''.$nim.' Terdaftar di DPT.');
				}elseif($model["status"]=='2'){
					Yii::app()->user->setFlash('verify1',''.$nim.' Sedang Melakukan Pemilihan.');
					$vis["button"]="hidden";
				}elseif($model["status"]=='3'){
					Yii::app()->user->setFlash('verify2',''.$nim.' Sudah Melakukan Pemilihan. ');
					$vis["button"]="hidden";
				}
			}else{	
				Yii::app()->user->setFlash('notverify',''.$nim.' Tidak Terdaftar di DPT.');
				$vis["form"]="hidden";
			}
		}else{
			Yii::app()->user->setFlash('time_end','Saat Ini Sistem Tidak Dapat Melakukan Verifikasi Pemilih. Karena Berada Di Luar Waktu Penggunaan Sistem');
				$vis["form"]="hidden";
				
		}
		$this->render('_form', array('model'=>$model,'vis'=>$vis));	
	}
	
	public function actionMasukBilik(){
			if(isset ($_POST['id_pemilih'],$_POST['bilik_ke'])){
				$user=Yii::app()->user->getUsername();
				$data=Tps::model()->getNamaTps($user);
		
				$id_pemilih=$_POST['id_pemilih'];
				$bilik_ke=$_POST['bilik_ke'];
				$model=Pemilih::model()->findByPk($id_pemilih);
				$model->status=2;
				$model->id_tps=$data['id_tps'];
				$model->bilik_ke=$bilik_ke;
				
					if($model->save()){
						Yii::app()->user->setFlash('berhasil_masuk','Peserta '.$model->nim.' Terautentikasi, Silahkan Melakukan Pemilihan Di Bilik No. '.$bilik_ke.'.');
					}else{
						Yii::app()->user->setFlash('gagal_masuk','Terjadi Kesalahan.');
					}
			}else{
					Yii::app()->user->setFlash('bilik_gagal','Bilik Belum Dipilih');
			}
			$this->redirect('index');
	}

	public function actionKeluarkanPeserta(){
			$id=$_GET['id_pemilih'];
			unset(Yii::app()->session['nim'],Yii::app()->session['id_pemilih'],Yii::app()->session['id_tps'], Yii::app()->session['id_fakultas'], Yii::app()->session['id_pemilihan']);
			if(Tps::model()->kickPeserta($id)){
				$this->redirect('index');
			}else{
				$this->redirect('index');
			}	  
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pemilih-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}