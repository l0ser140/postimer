<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cycle')); ?>:</b>
	<?php echo CHtml::encode($data->cycle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('planet')); ?>:</b>
	<?php echo CHtml::encode($data->planet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moon')); ?>:</b>
	<?php echo CHtml::encode($data->moon); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('alliance')); ?>:</b>
	<?php echo CHtml::encode($data->alliance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>