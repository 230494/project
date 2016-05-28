<?php

class PusatController extends Controller
{
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','mode'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','formtime','cetak','tambahwaktu','getdatalog'),
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
	
	public function actionIndex()
	{
	
		$this->render('index');
	}
	
	public function actionPengaturan()
	{
	
		$this->render('index');
	}
	
	public function actionLog()
	{
		
		$this->render('log');
	}
	
	public function actiongetdatalog(){
			$data=Log::model()->findAll();
			echo "<select multiple='multiple' style='width: 100%;height:250px'>";
			foreach( $data as $row):
			echo "<option>";
			echo $row['tanggal'].'	- '.$row['jam'].'	- '.$row['ip'].'	-	'.$row['browser'].'	-	'.$row['nim'].'	-	'.$row['refferer'].'	- '.$row['url'];
			echo "</option>";
			endforeach;
            echo "</select>";
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