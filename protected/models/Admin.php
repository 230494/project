<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id_admin
 * @property string $username
 * @property string $password
 */
class Admin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 
	public $confirm,$pwd_lama;
	 
	public function tableName()
	{
		return 'admin';
	}
	
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password,confirm,id_level', 'required'),
			array('username, password,confirm,pwd_lama', 'length', 'max'=>50),
			array('id_level', 'numerical', 'integerOnly'=>true),
		//	array('pwd_lama', 'empty'=>true,'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_admin, username, password,id_level,pwd_lama', 'safe', 'on'=>'search'),
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
			'id_admin' => 'Id Admin',
			'username' => 'Username',
			'password' => 'Password',
			'id_level'=>'ID Level',
			'confirm'=>'Konfirmasi Password',
			'pwd_lama'=>'Password Lama',
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

		$criteria->compare('id_admin',$this->id_admin);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('id_level',$this->id_level);
			
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getIdAdmin($user,$pwd){
		$data = Yii::app()->db->createCommand('Select id_admin from admin where username='.$user.' and password='.$pwd.' ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getUsernameAdmin($id_admin){
		$data = Yii::app()->db->createCommand('select username from admin where id_admin='.$id_admin.' ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getPasswordAdmin($id_admin){
		$data = Yii::app()->db->createCommand('select password from admin where id_admin='.$id_admin.' ');            
        $result = $data->queryScalar();            
        return $result; //return single value of xyz column
	}
	
	public function getInfoAdmin($id_admin){
		$data = Yii::app()->db->createCommand('select * from admin where id_admin='.$id_admin.' ');            
        $result = $data->queryRow();            
        return $result; //return single value of xyz column
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
