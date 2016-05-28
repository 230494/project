<?php

/**
 * This is the model class for table "tps".
 *
 * The followings are the available columns in table 'tps':
 * @property integer $id_tps
 * @property string $nama_tps
 * @property string $alamat_tps
 * @property string $longitude
 * @property string $latitude
 * @property integer $subjumlah_bilik
 */
class Tps extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $jumlahDPT;
	public $status;
	public function tableName()
	{
		return 'tps';
	}
	
	public function setSave($id_tps,$id_pemilihan){
		$kandidat=Kandidat::model()->findAll();
		foreach($kandidat as $r){
			$data = Yii::app()->db->createCommand('INSERT INTO  hasil_suara (id_tps,id_kandidat,id_pemilihan) VALUES ('.$id_tps.','.$r['id_kandidat'].','.$id_pemilihan.') ')->query(); 
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
			array('nama_tps, alamat_tps, longitude, latitude, subjumlah_bilik,id_admin,id_fakultas,kprw,p3w,pprw', 'required'),
			array('subjumlah_bilik,id_admin', 'numerical', 'integerOnly'=>true),
			array('nama_tps, alamat_tps, longitude, latitude', 'length', 'max'=>50),
			array('kprw, p3w, pprw', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tps, nama_tps, alamat_tps, p3w, kprw, pprw', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tps' => 'Id TPS',
			'nama_tps' => 'Nama TPS',
			'alamat_tps' => 'Alamat',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
			'subjumlah_bilik' => 'Jumlah Bilik',
			'id_fakultas' => 'Fakultas',
			'jumlahDPT' => 'Jumlah DPT',
			'status'=>'Kotak Suara',
			'kprw'=>'KPR Wilayah',
			'p3w'=>'P3 Wilayah',
			'pprw'=>'PPR Wilayah'
		);
	}
	
	public function getNamaTps($user)
	{
		$result = Yii::app()->db->createCommand() ->select('*') 
		->from('tps t')
		->join('admin a', 'a.id_admin=t.id_admin')
		->where('username=:username', array(':username'=>$user));

		//$result = Yii::app()->db->createCommand('Select nama_tps from admin a JOIN tps t ON a.id_admin=t.id_tps where a.username='.$user.'');            
		return $result->queryRow();
	}
	
	public function getInfoTps($id)
	{
		$result = Yii::app()->db->createCommand() ->select('*') 
		->from('tps t')
		->join('admin a', 'a.id_admin=t.id_admin')
		->where('id_tps=:id_tps', array(':id_tps'=>$id));

		//$result = Yii::app()->db->createCommand('Select nama_tps from admin a JOIN tps t ON a.id_admin=t.id_tps where a.username='.$user.'');            
		return $result->queryRow();
	}
	
	public function bilikDigunakan($option_bilik)
	{
		$result = Yii::app()->db->createCommand(' SELECT * FROM pemilih p JOIN pemilihan pe ON p.id_pemilihan=pe.id_pemilihan WHERE bilik_ke ='.$option_bilik.' AND p.status=2 AND pe.status = 1 ') ;
		//$result = Yii::app()->db->createCommand('Select nama_tps from admin a JOIN tps t ON a.id_admin=t.id_tps where a.username='.$user.'');            
		return $result->queryRow();
	}
	
	public function kickPeserta($id){
		$result = Yii::app()->db->createCommand('UPDATE pemilih SET bilik_ke = 0 WHERE id_pemilih ='.$id.' ');
		return $result;
	}
	
	public function getDPT($id){
		$result = Yii::app()->db->createCommand('SELECT count(*) from pemilih p JOIN fakultas f ON p.id_fakultas =f.id_fakultas JOIN tps t ON f.id_fakultas=t.id_fakultas WHERE t.id_tps='.$id.'');
		return $result->queryScalar();
	}
	
	public function kirimSuaraKandidat($id_tps){
		$result=Yii::app()->db->createCommand()
		->select('*')
		->from('hasil_suara h')
		->join('pemilihan p', 'p.id_pemilihan=h.id_pemilihan')
		->where('id_tps=:id_tps AND p.status=:status',array(':id_tps'=>$id_tps,':status'=>1));
		
		foreach($result as $row){
			Yii::app()->db->createCommand('UPDATE kandidat SET hasil = hasil+'.$row['hasil_suara'].' WHERE id_kandidat ='.$row['id_kandidat'].' ');
		}
		
		
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

		$criteria->compare('id_tps',$this->id_tps);
		$criteria->compare('nama_tps',$this->nama_tps,true);
		$criteria->compare('alamat_tps',$this->alamat_tps,true);
		$criteria->compare('kprw',$this->kprw,true);
		$criteria->compare('pprw',$this->pprw,true);
		$criteria->compare('p3w',$this->p3w,true);
		$criteria->compare('subjumlah_bilik',$this->subjumlah_bilik);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
