<?php

/**
 * This is the model class for table "pemilihan".
 *
 * The followings are the available columns in table 'pemilihan':
 * @property integer $id_pemilihan
 * @property string $nama_pemilihan
 * @property integer $jumlah_bilik
 * @property integer $status
 * @property string $start_time
 * @property string $end_time
 * @property string $add_time
 * @property string $logo
 */
class Pemilihan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 public $jumah_tps;
	public function tableName()
	{
		return 'pemilihan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_pemilihan, jumlah_bilik, start_time, end_time,logo', 'required'),
			array('jumlah_bilik, status', 'numerical', 'integerOnly'=>true),
		//	array('logo','required','on'=>'insert'),
			array('nama_pemilihan', 'length', 'max'=>100),
			array('start_time, end_time', 'length', 'max'=>50),
			array('add_time, logo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('logo', 'file', 'allowEmpty'=>true,'maxSize'=>1024*1024*5, //ukuran file max  5 MB
                             'types'=>'jpg,jpeg,png','tooLarge'=>'Ukuran foto tidak lebih dari 5Mb',
                             'wrongType'=>'Jenis file hanya JPEG atau PNG',
                             'on'=>'insert'),
                        array('logo', 'file', 'allowEmpty'=>true,'maxSize'=>1024*1024*5, 
                             'types'=>'jpg,jpeg,png','tooLarge'=>'Ukuran foto tidak lebih dari 5Mb',
                             'wrongType'=>'Jenis file hanya JPEG atau PNG',
                             'except'=>'insert'),

			
			array('id_pemilihan, nama_pemilihan, jumlah_bilik, status, start_time, end_time, add_time, logo', 'safe', 'on'=>'search'),
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
	
	public function getIdPemilihan(){
		$data = Yii::app()->db->createCommand('Select id_pemilihan from pemilihan where status=1 ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getNamaPemilihan(){
		$data = Yii::app()->db->createCommand('Select nama_pemilihan from pemilihan where status=1 ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getCurrentPemilihan(){
		$data=Yii::app()->db->createCommand('Select * from pemilihan where status=1 ');
		return $data->queryRow();
	}
	
	public function getJumlahTps($id){
		$data=Yii::app()->db->createCommand('SELECT count(*) FROM tps t JOIN pemilihan pe ON pe.id_pemilihan=t.id_pemilihan WHERE  pe.id_pemilihan='.$id.' ');
		return $data->queryScalar();
	}
 
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pemilihan' => 'Id Pemilihan',
			'nama_pemilihan' => 'Nama Pemilihan',
			'jumlah_bilik' => 'Jumlah Bilik Suara',
			'status' => 'Status',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'jumlah_tps' => 'Jumlah TPS',
			'logo' => 'Logo',
			
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

		$criteria->compare('id_pemilihan',$this->id_pemilihan);
		$criteria->compare('nama_pemilihan',$this->nama_pemilihan,true);
		$criteria->compare('jumlah_bilik',$this->jumlah_bilik);
		$criteria->compare('status',$this->status);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pemilihan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
