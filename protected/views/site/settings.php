<?php
$this->pageTitle=Yii::app()->name . ' - Settings';
$this->breadcrumbs=array(
	'Settings',
);
?>

<h1>Settings</h1>

<p>Here you can configure the Web Site Settings:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>true,
)); ?>

            
	<p class="note">Fields with <span class="required">*</span> are required.</p>
    
	<div class="row">
		<?php echo $form->label($model,'requireLogin'); ?>
        <?php echo $form->checkBox($model,'requireLogin'); ?>
		<?php echo $form->error($model,'requireLogin'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'adminEmail'); ?>
        <?php echo $form->textField($model,'adminEmail'); ?>
        <?php echo $form->error($model,'adminEmail'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model,'cronjobEmail'); ?>
        <?php echo $form->textField($model,'cronjobEmail'); ?>
        <?php echo $form->error($model,'cronjobEmail'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model,'theme'); ?>
        <?php echo $form->dropDownList($model,'theme',$model->themelist); ?>
        <?php echo $form->error($model,'theme'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model,'indexHeader'); ?>
        <?php echo $form->textArea($model,'indexHeader'); ?>
        <?php echo $form->error($model,'indexHeader'); ?>
    </div>    

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
    
    <div class="row">
        <p class="note">Database Settings are Display Only - Must be updated in the INI file</p>
        <?php echo $form->labelEx($model,'dbname'); ?>
        <?php echo $form->textField($model,'dbname',array('disabled'=>TRUE)); ?>
        <?php echo $form->error($model,'dbname'); ?>
        <?php echo $form->labelEx($model,'dbuser'); ?>
        <?php echo $form->textField($model,'dbuser',array('disabled'=>TRUE)); ?>
        <?php echo $form->error($model,'dbuser'); ?>
        <?php echo $form->labelEx($model,'dbpassword'); ?>
        <?php echo $form->passwordField($model,'dbpassword',array('disabled'=>TRUE)); ?>
        <?php echo $form->error($model,'dbpassword'); ?>
        <?php echo $form->labelEx($model,'dbprefix'); ?>
        <?php echo $form->textField($model,'dbprefix',array('disabled'=>TRUE)); ?>
        <?php echo $form->error($model,'dbprefix'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
