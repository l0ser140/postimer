<?php
  class SettingsForm extends CFormModel
{

    public $inifile;
    
    //database name
    //note that the name is Case Sensitive !
    // the default table name is 'postimer'.       
    public $dbname;
      
    //database user
    public $dbuser;
    //databse password
    public $dbpassword;  
    //database table prefix
    //the default prefix is blank. 
    //You may need to change this if you are combining the POSTimer database with another MySQL database
    //and need to ensure that table names do not conflict.
    public $dbprefix;
      
    // contact e-mail address
    public $adminEmail;

    // e-mail address for POS Timer notifications      
    public $cronjobEmail;
      
    // define if user must Log In to view POS Timer Info.
    // TRUE = login is required, FALSE = no login required
    // Note : DO NOT ENCLOSE TRUE OR FALSE IN QUOTES !! 
    public $requireLogin;
      
    // define a header message for the main index page
    public $indexHeader;

    // define a site layout theme
    public $theme;
    public $themelist;
    
    public function rules()
    {
        return array(
            array('dbname, dbuser, dbpassword', 'required'),
            array('adminEmail, cronjobEmail','email'), 
            array('requireLogin', 'boolean'),
            array('indexHeader','length', 'max'=>80),
            array('theme','length', 'max'=>120),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'dbname'=>'Database Name',
            'dbuser'=>'Database Username',
            'dbpassword'=>'Database Password',
            'dbprefix'=>'Database Table Prefix',
            'requireLogin'=>'Require User Login To View Timers',
            'adminEmail'=>'Site Contact Email Address',
            'cronjobEmail'=>'Upcoming Timer Email Address',
            'indexHeader'=>'Home Page Header Message',
            'theme'=>'Site Theme'
        );
    }
    
    public function readSettings()
    {
        $this->inifile=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'settings.ini';    
        $settings=parse_ini_file($this->inifile);    
        $this->dbname=$settings['dbname'];
        $this->dbuser=$settings['dbuser'];
        $this->dbpassword=$settings['dbpassword'];
        $this->dbprefix=$settings['dbprefix'];
        $this->requireLogin=$settings['requireLogin'];
        $this->adminEmail=$settings['adminEmail'];
        $this->cronjobEmail=$settings['cronjobEmail'];
        $this->indexHeader=$settings['indexHeader'];
        $this->theme=$settings['theme'];
        
        // Get a list of theme names from the theme directory
        $themedir=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'themes';
        $dirlist=scandir($themedir);
        foreach($dirlist as $themename){
            if(!is_dir($themename))$this->themelist[$themename]=$themename;
        }
    }
    
    public function writeSettings(){
        $settings = array('dbname'=>$this->dbname,
              'dbuser'=>$this->dbuser,
              'dbpassword'=>$this->dbpassword,
              'dbprefix'=>$this->dbprefix,
              'requireLogin'=>$this->requireLogin,
              'adminEmail'=>$this->adminEmail,
              'cronjobEmail'=>$this->cronjobEmail,
              'indexHeader'=>$this->indexHeader,
              'theme'=>$this->theme,
        );
        $this->write_php_ini($settings,$this->inifile);      
    }
    
    function write_php_ini($array, $file)
    {
        $res = array();
        foreach($array as $key => $val)
        {
            if(is_array($val))
            {
                $res[] = "[$key]";
                foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
            }
            else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
        }
        $this->safefilerewrite($file, implode("\r\n", $res));
    }
    //////
    function safefilerewrite($fileName, $dataToSave)
    {    if ($fp = fopen($fileName, 'w'))
        {
            $startTime = microtime();
            do
            {            $canWrite = flock($fp, LOCK_EX);
               // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
               if(!$canWrite) usleep(round(rand(0, 100)*1000));
            } while ((!$canWrite)and((microtime()-$startTime) < 1000));

            //file was locked so now we can store information
            if ($canWrite)
            {            fwrite($fp, $dataToSave);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }

    }

}
?>
