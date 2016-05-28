<?php

class HasilController extends Controller
{
	//public $layout='//layouts/column2';
	
	public function actionIndex(){	
		$record=Fakultas::model()->findAll();	
		$data=Kandidat::model()->getHasilKandidat();
		$dat=Kandidat::model()->getHasilKandidatByFak();
		$model=Pemilihan::model()->getCurrentPemilihan();
		$this->render('index', array(
			'data'=>$data,'record'=>$record,'dat'=>$dat,'model'=>$model));
	}
	
	
	public function actiongetgrafik(){
		$record=Fakultas::model()->findAll();	
		$data=Kandidat::model()->getHasilKandidat();
		$dat=Kandidat::model()->getHasilKandidatByFak();
		$model=Pemilihan::model()->getCurrentPemilihan();
		$this->render('data', array(
			'data'=>$data,'record'=>$record,'dat'=>$dat,'model'=>$model));
	}
}