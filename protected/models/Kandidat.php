<?php

/**
 * This is the model class for table "kandidat".
 *
 * The followings are the available columns in table 'kandidat':
 * @property integer $id_kandidat
 * @property string $nama_kandidat
 * @property string $foto
 * @property integer $hasil
 * @property string $saksi
 * @property integer $id_pemilihan
 */
class Kandidat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 
	 public $foto_lama;
	public function tableName()
	{
		return 'kandidat';
	}
	
	public function setSave($id_kandidat,$id_pemilihan){
		$fak=Fakultas::model()->findAll();
		foreach($fak as $r){
			$data = Yii::app()->db->createCommand('INSERT INTO  hasil_suara_fak (id_fakultas,id_kandidat,id_pemilihan) VALUES ('.$r['id_fakultas'].','.$id_kandidat.','.$id_pemilihan.') ')->query(); 
				//	if($data) return true;
					//else return false;
		}
  
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_kandidat, saksi,hasil,no_urut,id_pemilihan', 'required'),
			array('foto,foto_lama', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true, 'on'=>'update'),
			array('foto', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>false, 'on'=>'create'),
			array('hasil, id_pemilihan,no_urut', 'numerical', 'integerOnly'=>true),
			array('nama_kandidat, foto, saksi', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_kandidat, nama_kandidat, foto, hasil, saksi, id_pemilihan,no_urut', 'safe', 'on'=>'search'),
		);
	}
	
	public function getAllKandidat(){
		$data = Yii::app()->db->createCommand('select * from pemilihan p JOIN kandidat k ON  p.id_pemilihan=k.id_pemilihan where p.status=1');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	
	public function berikanSuaraKandidat($id,$bilik){
		$query1=Yii::app()->db->createCommand("UPDATE kandidat SET hasil=hasil+1 WHERE id_kandidat=".$id."  AND id_pemilihan=".Yii::app()->session['id_pemilihan']." ")->query();
		$query2=Yii::app()->db->createCommand("UPDATE hasil_suara SET hasil_suara=hasil_suara+1 WHERE id_kandidat=".$id." AND id_pemilihan=".Yii::app()->session['id_pemilihan']." AND id_tps=".Yii::app()->session['id_tps']." ")->query();
		$query3=Yii::app()->db->createCommand("UPDATE hasil_suara_fak SET hasil=hasil+1 WHERE id_kandidat=".$id."  AND id_pemilihan=".Yii::app()->session['id_pemilihan']." AND id_fakultas=".Yii::app()->session['id_fakultas']." ")->query();
		//$query1=Yii::app()->db->createCommand('update kandidat set hasil=hasil+1 where id_kandidat='.$id.' ')->query();
		if($query1 && $query2 && $query3){
			if($bilik==1){
				$query4=Yii::app()->db->createCommand('update pemilih set status=3 where id_pemilih='.Yii::app()->session['id_pemilih'].' ')->query();
			}else{
				$query4=Yii::app()->db->createCommand('update pemilih set status=3 where id_pemilih='.Yii::app()->session['id_pemilih2'].' ')->query();
			}
				if($query4){
					return true;
				}else{
					return false;
				}
		}else{
			return false;
		}
		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_kandidat' => 'No Urut',
			'nama_kandidat' => 'Nama Kandidat',
			'foto' => 'Foto',
			'hasil' => 'Hasil',
			'saksi' => 'Saksi',
			'no_urut'=>'No Urut',
			'id_pemilihan' => 'Pemilihan',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	 
	 public function getPemilihanKandidat($id){
		$data = Yii::app()->db->createCommand('select * from pemilihan p JOIN kandidat k ON  p.id_pemilihan=k.id_pemilihan where p.status=1 AND  k.id_kandidat='.$id.'');            
        $result = $data->queryRow();            
        return $result; //return single value of xyz column
		}
		
	public function getHasilKandidatByFak(){
		$data = Yii::app()->db->createCommand('select distinct fakultas,h.id_fakultas from hasil_suara_fak h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN fakultas f ON h.id_fakultas=f.id_fakultas JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getHasilKandidatByFak2($id){
		$data = Yii::app()->db->createCommand('select distinct h.hasil from hasil_suara_fak h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN fakultas f ON h.id_fakultas=f.id_fakultas JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1 AND h.id_fakultas='.$id.' ');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getHasilKandidatByKan(){
		$data = Yii::app()->db->createCommand('select distinct nama_kandidat from hasil_suara_fak h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN fakultas f ON h.id_fakultas=f.id_fakultas JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	 
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('no_urut',$this->no_urut,true);
		$criteria->compare('id_kandidat',$this->id_kandidat);
		$criteria->compare('nama_kandidat',$this->nama_kandidat,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('hasil',$this->hasil);
		$criteria->compare('saksi',$this->saksi,true);
		$criteria->compare('id_pemilihan',$this->id_pemilihan);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getIdKandidat($id){
		$data = Yii::app()->db->createCommand('Select id_kandidat from kandidat where id_kandidat='.$id.' ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	

	public function getHasilKandidat(){
		$data = Yii::app()->db->createCommand('select id_kandidat,nama_kandidat,hasil,foto from kandidat ');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getHasilKandidatTPS(){
		$data = Yii::app()->db->createCommand('select distinct t.nama_tps, h.id_tps,longitude,latitude from hasil_suara h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN tps t ON h.id_tps=t.id_tps JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getHasilKandidatByTPS($id){
		$data = Yii::app()->db->createCommand('select distinct h.hasil_suara from hasil_suara h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN tps t ON h.id_tps=t.id_tps JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1 AND h.id_tps='.$id.' ');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	
		public function getHasilKandidatByMonitor($id){
		$data = Yii::app()->db->createCommand('select distinct h.hasil_suara,nama_kandidat,no_urut,hasil,foto from hasil_suara h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN tps t ON h.id_tps=t.id_tps JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1 AND h.id_tps='.$id.' ');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getHasilKandidatByMax($id){
	  if($max = Yii::app()->db->createCommand('select max(hasil_suara)  from hasil_suara  where  id_tps in  (select id_tps  from hasil_suara where id_tps='.$id.' )')->queryScalar()) {
		$data = Yii::app()->db->createCommand('select no_urut  from hasil_suara h JOIN kandidat k ON  h.id_kandidat=k.id_kandidat JOIN tps t ON h.id_tps=t.id_tps JOIN pemilihan p ON h.id_pemilihan=p.id_pemilihan where p.status=1 AND h.id_tps='.$id.'  AND hasil_suara='.$max.'');            
	  $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	  }
	  
	  
		
	}
	
	public function deleteAllKandidat($id){
			Yii::app()->db->createCommand(' delete from hasil_suara_fak where id_kandidat='.$id.' ')->query(); 
			Yii::app()->db->createCommand(' delete from hasil_suara where id_kandidat='.$id.' ')->query(); 
	  
	  }
	  
	  public function getKandidatByID($id){
		$data=Yii::app()->db->createCommand('Select * from kandidat k JOIN pemilihan pe ON pe.id_pemilihan=k.id_pemilihan where pe.status=1 AND k.id_kandidat='.$id.' ');
		return $data->queryRow();
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kandidat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
