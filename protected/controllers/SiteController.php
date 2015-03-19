<?php

class SiteController extends RController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    public function actionRssfeed()
    {
        // Don't Publish the RSS Feed if the Site index requires a login
        if (Yii::app()->params['requireLogin']) return;
        
        
        // OK to publish an RSS feed of Active Timers
        // get All the timers
        
        $model=new Pos;
        $poslist=$model->findAll();
      
        Yii::import('ext.feed.*');
     
        // Create a feed object
        // RSS 2.0 is the default type
        $feed = new EFeed();
        
        // Set the title to Match the Web Site 
        $feed->title= Yii::app()->name;
        $feed->description = Yii::app()->params['indexHeader'];
        $sitename=str_replace('localhost','127.0.0.1',Yii::app()->getBaseUrl($absolute=true));
        $feed->setLink($sitename);
        
        // add an item for each POS
        if (count($poslist)): 
            foreach ($poslist as $pos)
            { 
                $item = $feed->createNewItem();
                 
                $item->title = $pos->type.' in '.$pos->location.' is due out of '.$pos->cycle.' cycle at '.$pos->date ;
                $item->link = Yii::app()->getBaseUrl($absolute=true).'?='.$pos->id;
                $item->date = $pos->date;
                $item->addTag('guid', Yii::app()->getBaseUrl($absolute=true).'?='.$pos->id ,array('isPermaLink'=>'true'));
                 
                $feed->addItem($item);
            }
        else:
            //nothing to add
            $item = $feed->createNewItem();
            $item->title = "No Timers posted";
            $item->link = Yii::app()->getBaseUrl($absolute=true).'?='.$pos->id; 
            $item->date = date(DATE_RFC822);
            $feed->addItem($item);
        endif;
             
        $feed->addChannelTag('language', 'en-us');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));

        // generate the feed and display it
        $feed->generateFeed();

        // Dont need to render anything
        //$this->render('rssfeed',array('feed'=>$feed));
    }
    
    public function actionSettings()
    {
        if(!Yii::app()->getModule('user')->isAdmin()) $this->redirect(array('user/login'));
        
        $model=new SettingsForm();
        $model->readSettings();
        
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='settings-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['SettingsForm']))
        {
            $model->attributes=$_POST['SettingsForm'];
            // validate user input and save if OK
            if($model->validate())
                $model->writeSettings();
        }
        // display the login form
        $this->render('settings',array('model'=>$model));
    
    }
}