<div class="form">

<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'pos-form',
	'enableAjaxValidation'=>false,
)); 

$i=0;
$mapsolarsystems=Mapsolarsystems::model()->findAll(array('select'=>'solarSystemName'));
foreach ($mapsolarsystems as $mapsolarsystem) {$systemname[$i]=$mapsolarsystem->solarSystemName; $i++;}

date_default_timezone_set('UTC');
    
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php /* echo $form->textField($model,'location',array('size'=>6,'maxlength'=>6)); */?>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'model'=>$model,
                            'attribute'=>'location',
                            'value'=>$model->location,
                            'source'=>$systemname,
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                'minLength'=>'2',
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px;'
                            ),
                            ));
?>  

		<?php echo $form->error($model,'location'); ?>
	</div>

    <div class="row">
    <table>
        <tr>
        <td><?php echo $form->labelEx($model,'type'); ?></td>
        <td><?php echo $form->labelEx($model,'planet'); ?></td>
        <td><?php echo $form->labelEx($model,'moon'); ?></td>
        <td><?php echo $form->labelEx($model,'alliance'); ?></td>
        <td><?php echo $form->labelEx($model,'friendly'); ?></td>
        </tr>
        <tr>
        <td><?php echo $form->dropDownList($model,'type',array('POS'=>'POS', 'POCO'=>'POCO', 'Station'=>'Station', 'IHUB'=>'IHUB','TCU'=>'TCU')); ?></td>
        <td><?php echo $form->textField($model,'planet'); ?></td>
        <td><?php echo $form->textField($model,'moon'); ?></td>    
        <td><?php echo $form->textField($model,'alliance'); ?></td>
        <td><?php echo $form->dropDownList($model,'friendly',$model->enumItem('friendly')); ?></td>
        </tr>
        <tr>
        <td><?php echo $form->error($model,'type'); ?></td>
        <td><?php echo $form->error($model,'planet'); ?></td>    
        <td><?php echo $form->error($model,'moon'); ?></td>
        <td><?php echo $form->error($model,'alliance'); ?></td>
        <td><?php echo $form->error($model,'friendly'); ?></td> 
        </tr>
    </table>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cycle'); ?>
        <?php echo $form->dropDownList($model,'cycle',array('Shield'=>'Shield', 'Armor'=>'Armor', 'Final'=>'Final')); ?>
        <?php echo $form->error($model,'cycle'); ?>
    </div>

    <div class="row">    
        <?php echo $form->labelEx($model,'notes'); ?>
        <?php echo $form->textArea($model,'notes'); ?>
        <?php echo $form->error($model,'notes'); ?>
    </div>

    <div class="row">
    <table>
        <tr>
            <td><?php echo $form->labelEx($model,'days'); ?></td>
            <td><?php echo $form->labelEx($model,'hours'); ?></td>
            <td><?php echo $form->labelEx($model,'minutes'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'days'); ?></td>
            <td><?php echo $form->textField($model,'hours'); ?></td>
            <td><?php echo $form->textField($model,'minutes'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->error($model,'days'); ?></td>
            <td><?php echo $form->error($model,'hours'); ?></td>
            <td><?php echo $form->error($model,'minutes'); ?></td>
        </tr>
    </table>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
        <?php $this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'date',
            'options'=>array(
                'hourGrid' => 4,
                'hourMin' => 0,
                'hourMax' => 24,
                'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
                ),
            ));?>  
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
