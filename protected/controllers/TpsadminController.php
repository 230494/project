<?php

class TpsadminController extends Controller{


	public function accessRules(){
		$user=Yii::app()->user->getUsername();
		$data=Tps::model()->getNamaTps($user);
		Yii::app()->session->add('nama_tps', $data['nama_tps']);
		Yii::app()->session->add('id_tps', $data['id_tps']);
				return array(
					array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('index','updateajax','cek'),
					'users'=>array('*'),
				),);
	}
		
	public function actionIndex(){
		$this->render('index');
	}
	
	public function actionKirimSuratSuara(){
		if(Tps::model()->kirimSuaraKandidat()){
			Yii::app()->user->setFlash('berhasil_kirim','Surat Suara Berhasil Dikirim.');
		}else{
			Yii::app()->user->setFlash('gagal_kirim','Terjadi Kesalahan.');
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
}