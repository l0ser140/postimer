<?php
$this->breadcrumbs=array(
	'Timers',
);

$this->menu=array(
	array('label'=>'Create Timers', 'url'=>array('create')),
	array('label'=>'Manage Timers', 'url'=>array('admin')),
);
?>

<h1>Timers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
