<?php

/**
 * This is the model class for table "pos".
 *
 * The followings are the available columns in table 'pos':
 * @property integer $id
 * @property string $location
 * @property string $type
 * @property string $cycle
 * @property string $date
 * @property integer $planet
 * @property integer $moon
 * @property string $alliance
 * @property string $notes
 * @property enum $friendly
 * @property string $posted_by
 * 
 */
class Pos extends CActiveRecord
{

    public $days = 0;
    public $hours = 0;
    public $minutes = 0;
    
    public function beforeSave()
    {
        
        date_default_timezone_set('UTC');             
        if ($this->days > 0 or $this->hours > 0 or $this->minutes>0):
            $this->date = (date("Y-m-d H:i:s", strtotime( "+". $this->days ." days "
                                                             . $this->hours ." hours "
                                                             . $this->minutes." minutes")));
        endif;
        $this->posted_by = Yii::app()->user->name;
        return true;           
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @return Pos the static model class
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
		return 'pos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location, type, cycle, date', 'required'),
			array('planet, moon', 'numerical', 'integerOnly'=>true),
            array('location', 'length', 'max'=>20),
			array('cycle, alliance, friendly', 'length', 'max'=>6),
			array('type', 'length', 'max'=>7),
			array('notes', 'length', 'max'=>160),
            array('days, hours, minutes','numerical','integerOnly'=>true),
            // array('hours, minutes','length','max'=>2),
            // array('days','length','max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, location, type, cycle, date, planet, moon, alliance, notes, friendly', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'location' => 'Location',
			'type' => 'Type',
			'cycle' => 'Cycle',
			'date' => 'Date',
			'planet' => 'Planet',
			'moon' => 'Moon',
			'alliance' => 'Alliance',
			'notes' => 'Notes',
                        'days'=>'Days',
                        'hours'=>'Hours',
                        'minutes'=>'Mins',
                        'friendly' =>'Friendly',
                        'posted_by' =>'Posted by',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('cycle',$this->cycle,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('planet',$this->planet);
		$criteria->compare('moon',$this->moon);
		$criteria->compare('alliance',$this->alliance,true);
		$criteria->compare('notes',$this->notes,true);
                $criteria->compare('friendly',$this->friendly,true);
                $criteria->compare('posted_by',$this->friendly,true);

		$dp = new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'sort'=>array('defaultOrder'=>'date ASC'),
		));
        
        $dp->setPagination(array('pageSize'=>$dp->getTotalItemCount()));

        
        return $dp;
	}

    /**
     * Retrieves a list of all models.
     * @return CActiveDataProvider.
     */
    public function getAll()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $dp = new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
            'sort'=>array('defaultOrder'=>'date ASC'),
        ));
        
        $dp->setPagination(array('pageSize'=>$dp->getTotalItemCount()));

        
        return $dp;
    }
    
     /**
     * Retrieves a list of actual pos timers
     * @return CActiveDataProvider.
     */
    public function getActual()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = 'date >= CONVERT_TZ(now() - INTERVAL 1 DAY, @@session.time_zone, "UTC")';
        
        $dp = new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
            'sort'=>array('defaultOrder'=>'date ASC'),
        ));
        
        $dp->setPagination(array('pageSize'=>$dp->getTotalItemCount()));

        
        return $dp;
    }
    
    /**
     * Retrieves a list of actual pos timers
     * @return CActiveDataProvider.
     */
    public function getOld()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = 'date < CONVERT_TZ(now() - INTERVAL 1 DAY, @@session.time_zone, "UTC")';
        
        $dp = new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
            'sort'=>array('defaultOrder'=>'date DESC'),
        ));
        
        $dp->setPagination(array('pageSize'=>50));

        
        return $dp;
    }
    
    public function enumItem($attribute)
        {
                $attr=$attribute;
                preg_match('/\((.*)\)/',$this->tableSchema->columns[$attr]->dbType,$matches);
                foreach(explode(',', $matches[1]) as $value)
                {
                        $value=str_replace("'",null,$value);
                        $values[$value]=Yii::t('enumItem',$value);
                }
                
                return $values;
        }
          

    public function timer($start, $end="NOW")
    {
        $sdate = strtotime($start);
        $edate = strtotime($end);
        $expired = False;
        
        $time = $edate - $sdate;
        if ($time < 0) {
            $expired = True;
            $time *= -1;
        }
        if($time>=0 && $time<=59) {
                // Seconds
                $timeshift = $time.'s';

        } elseif($time>=60 && $time<=3599) {
                // Minutes + Seconds
                $pmin = ($time) / 60;
                $premin = explode('.', $pmin);
               
                $presec = $pmin-$premin[0];
                $sec = $presec*60;
               
                $timeshift = $premin[0].'m '.round($sec,0).'s';

        } elseif($time>=3600 && $time<=86399) {
                // Hours + Minutes
                $phour = ($time) / 3600;
                $prehour = explode('.',$phour);
               
                $premin = $phour-$prehour[0];
                $min = explode('.',$premin*60);
               
                if (array_key_exists(1, $min))
                {
                        $presec = '0.'.$min[1];
                }
                else
                {
                        $presec = '0';
                }
                $sec = $presec*60;

                $timeshift = $prehour[0].'h '.$min[0].'m '.round($sec,0).'s';

        } elseif($time>=86400) {
                // Days + Hours + Minutes
                $pday = ($time) / 86400;
                $preday = explode('.',$pday);

                $phour = $pday-$preday[0];
                $prehour = explode('.',$phour*24);

                $premin = ($phour*24)-$prehour[0];
                $min = explode('.',$premin*60);
               
                if (array_key_exists(1, $min))
                {
                        $presec = '0.'.$min[1];
                }
                else
                {
                        $presec = '0';
                }
                $sec = $presec*60;
               
                $timeshift = $preday[0].'d '.$prehour[0].'h '.$min[0].'m '.round($sec,0).'s';

        }
        if ($expired) return '-'.$timeshift;
        return $timeshift;
    }
    
    public function is_expired($start, $end="NOW")
    {
        $sdate = strtotime($start);
        $edate = strtotime($end);
        if( $edate - $sdate > 0) {
            return False;
        }
        return True;
    }
    
    public function date_html($start, $end="NOW")
    {
        if (is_expired($start, $end))
        {
            $html = '<span class="exptext">Expired</span><span class="timer">'. $this->timer($start, $end) .'</span>';
        } else {
            $html = '<span class="timer">'. $this->timer($start, $end) .'</span>';
        }
        return $html;
    }
}
