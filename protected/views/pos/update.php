<?php
$this->breadcrumbs=array(
	'Timers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Timers', 'url'=>array('index')),
	array('label'=>'Create Timer', 'url'=>array('create')),
	array('label'=>'View Timers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Timers', 'url'=>array('admin')),
);
?>

<h1>Update Timer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>