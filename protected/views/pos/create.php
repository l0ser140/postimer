<?php
$this->breadcrumbs=array(
	'Timers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Timers', 'url'=>array('index')),
	array('label'=>'Manage Timers', 'url'=>array('admin')),
);
?>

<h1>Create Timer</h1>

<?php 
    //Initialise the POS Timer date to NOW
    $model->date=date('Y-m-d H:i:s'); 
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>