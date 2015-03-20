<?php $this->pageTitle=Yii::app()->name; ?>

<h1><?php echo Yii::app()->params['indexHeader']?> </h1>

<?php

    date_default_timezone_set('UTC');
    
    $model= new Pos; 
    
    if (!Yii::app()->user->isGuest or !Yii::app()->params['requireLogin'])
	{ 
        echo '<script src="http://'. $_SERVER['HTTP_HOST'] .'/static/countdown.js" type="text/javascript"></script>'.PHP_EOL;
        echo '<script src="http://'. $_SERVER['HTTP_HOST'] .'/static/timers.js" type="text/javascript"></script>'.PHP_EOL;
        $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'timers-grid',
        //'cssFile'=>Yii::app()->theme->skinPath,
        'cssFile'=>'/css/styles.css',
        'dataProvider'=>$model->getAll(),
        'enableSorting'=>false,
        'selectableRows'=>0,
        'rowCssClassExpression' => '$data->friendly == "No" ? "hostile" : "allied"',
        'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',
        'columns'=>array(
            array(
                'class'=>'CLinkColumn',
                'labelExpression'=>'"<b>".$data->location."</b>"',
                'urlExpression'=>'"http://evemaps.dotlan.net/system/".$data->location',
                'header'=>'Location',
                'linkHtmlOptions'=>array('style'=>'color: white;','target'=>'_blank'),
            ),
            'type',
            'cycle',
            'planet',
            'moon',
            'alliance',
            'friendly',
            array('header' => 'EVE Time',
                  'name'=>'eve_time',
                  'value'=>'$data->date',
                  'htmlOptions'=>array('class'=>'date'),
                 ),
            array('class'=>'DataColumn',
                  'header' => 'Time Remaining',
                  'name'=>'time_remaining',
                  'type' => 'raw',
                  'value'=>'$data->date_html("NOW", $data->date)',
                  'evaluateHtmlOptions'=>true,
                  'htmlOptions'=>array('class'=>'$data->is_expired("NOW", $data->date) == True ? "remaining expired" : "remaining"'),
                 ),
            'notes',
            ),
        'htmlOptions'=>array('style'=>'color: black;'),
        ));
        echo '<script> window.setInterval("updateTimers()", 1000); </script>'.PHP_EOL;
        echo '<script> window.setInterval("$.fn.yiiGridView.update(\'timers-grid\')", 60000); </script>'.PHP_EOL;
	}
    else
        echo 'You must log in to view the Timer information';        
?>
