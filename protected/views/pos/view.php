<?php
$this->breadcrumbs=array(
	'Timers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Timers', 'url'=>array('index')),
	array('label'=>'Create Timers', 'url'=>array('create')),
	array('label'=>'Update Timers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Timers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Timers', 'url'=>array('admin')),
);
?>

<h1>View Timer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'location',
		'type',
		'cycle',
		'date',
		'planet',
		'moon',
		'alliance',
        'friendly',
		'notes',
	),
)); ?>
