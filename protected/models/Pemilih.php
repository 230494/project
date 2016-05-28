<?php

/**
 * This is the model class for table "pemilih".
 *
 * The followings are the available columns in table 'pemilih':
 * @property string $nim
 * @property string $nama_pemilih
 * @property integer $status
 * @property integer $bilik_ke
 * @property integer $id_pemilihan
 * @property string $kode_fakultas
 * @property integer $id_tps
 */
class Pemilih extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pemilih';
	}
	public function countByPemilihan($id){
		$data = Yii::app()->db->createCommand('SELECT count(*)  FROM pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  where pe.id_pemilihan='.$id.'');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getPemilihByVoteFak(){
		$data = Yii::app()->db->createCommand('SELECT DISTINCT p.id_fakultas,f.fakultas  FROM pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  JOIN fakultas f ON p.id_fakultas=f.id_fakultas WHERE pe.status=1 ORDER BY p.id_fakultas');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getPemilihByVoteFak2($id){
		$data = Yii::app()->db->createCommand('SELECT  p.id_fakultas,f.fakultas,p.status  FROM pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  JOIN fakultas f ON p.id_fakultas=f.id_fakultas WHERE pe.status=1 AND p.id_fakultas = '.$id.' ');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getPemilihByVoteTPS(){
		$data = Yii::app()->db->createCommand('SELECT DISTINCT p.id_tps,t.nama_tps  FROM pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  JOIN tps t ON p.id_tps=t.id_tps WHERE pe.status=1 ORDER BY p.id_tps');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getPemilihByVoteTPS2($id){
		$data = Yii::app()->db->createCommand('SELECT  p.id_tps,t.nama_tps,p.status  FROM pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  JOIN tps t ON p.id_tps=t.id_tps WHERE pe.status=1 AND p.id_tps = '.$id.' ');            
        $result = $data->queryAll();            
        return $result; //return single value of xyz column
	}
	
	public function getPemilihTPS($id){
		$data = Yii::app()->db->createCommand('select count(*) from pemilih where  status=3 AND id_tps='.$id.' ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	
	public function getPemilihSedangMemilih($bilik){
		$data = Yii::app()->db->createCommand('select * from pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  where pe.status=1 AND p.status=2 AND bilik_ke='.$bilik.'');            
        $result = $data->queryRow();            
        return $result; //return single value of xyz column
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nim, nama_pemilih,  id_fakultas', 'required'),
			array('id_pemilih,status, bilik_ke, id_pemilihan, id_tps', 'numerical', 'integerOnly'=>true),
			array('nim', 'length', 'max'=>9),
			array('nama_pemilih', 'length', 'max'=>40),
			array('id_fakultas', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pemilih,nim, nama_pemilih, status, bilik_ke, id_pemilihan, id_fakultas, id_tps', 'safe', 'on'=>'search'),
		);
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
	
	public function getStatus(){
		return array(
			array('id'=>'1', 'title'=>'Belum Memilih'),
			array('id'=>'2', 'title'=>'Sudah Memilih'),
		);
	}

	public function getInfoPemilih($nim){
		
		$result = Yii::app()->db->createCommand() 
		->select('p.status,nama_pemilih, fakultas,id_pemilih') 
		->from('fakultas f')
		->join('pemilih p', 'p.id_fakultas=f.id_fakultas')
		->join('pemilihan pe', 'p.id_pemilihan=pe.id_pemilihan')
		->where('nim=:nim1 ', array(':nim1'=>$nim));

		//$result = Yii::app()->db->createCommand('Select nama_tps from admin a JOIN tps t ON a.id_admin=t.id_tps where a.username='.$user.'');            
		return $result->queryRow();
	}
	

	
	public function getPemilihByVote(){
		$data = Yii::app()->db->createCommand('select count(*) from pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  where pe.status=1 AND p.status=2');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getPemilihByNotVote(){
		$data = Yii::app()->db->createCommand('select count(*) from pemilih p JOIN pemilihan pe ON  p.id_pemilihan=pe.id_pemilihan  where pe.status=1 AND (p.status =2 OR p.status=1)');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pemilih' => 'ID Pemilih',
			'nim' => 'Nim',
			'nama_pemilih' => 'Nama Pemilih',
			'status' => 'Status',
			'bilik_ke' => 'Bilik Ke',
			'id_pemilihan' => 'Id Pemilihan',
			'id_fakultas' => 'Fakultas',
			'id_tps' => 'TPS',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('id_pemilih',$this->id_pemilih,true);
		$criteria->compare('nama_pemilih',$this->nama_pemilih,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('bilik_ke',$this->bilik_ke);
		$criteria->compare('id_pemilihan',$this->id_pemilihan);
		$criteria->compare('id_fakultas',$this->id_fakultas,true);
		$criteria->compare('id_tps',$this->id_tps);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pemilih the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
