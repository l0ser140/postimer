<?php

/**
 * This is the model class for table "mapsolarsystems".
 *
 * The followings are the available columns in table 'mapsolarsystems':
 * @property integer $regionID
 * @property integer $constellationID
 * @property integer $solarSystemID
 * @property string $solarSystemName
 * @property double $x
 * @property double $y
 * @property double $z
 * @property double $security
 */
class Mapsolarsystems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Mapsolarsystems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mapsolarsystems';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('regionID, constellationID, solarSystemID', 'numerical', 'integerOnly'=>true),
			array('x, y, z, security', 'numerical'),
			array('solarSystemName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('regionID, constellationID, solarSystemID, solarSystemName, x, y, z, security', 'safe', 'on'=>'search'),
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
			'regionID' => 'Region',
			'constellationID' => 'Constellation',
			'solarSystemID' => 'Solar System',
			'solarSystemName' => 'Solar System Name',
			'x' => 'X',
			'y' => 'Y',
			'z' => 'Z',
			'security' => 'Security',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('regionID',$this->regionID);
		$criteria->compare('constellationID',$this->constellationID);
		$criteria->compare('solarSystemID',$this->solarSystemID);
		$criteria->compare('solarSystemName',$this->solarSystemName,true);
		$criteria->compare('x',$this->x);
		$criteria->compare('y',$this->y);
		$criteria->compare('z',$this->z);
		$criteria->compare('security',$this->security);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}