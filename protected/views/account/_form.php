<?php
/* @var $this AccountController */
/* @var $account Account */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($account); ?>

	<div class="row">
		<?php echo $form->labelEx($user,'firstname'); ?>
		<?php echo $form->textField($user,'firstname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'middlename'); ?>
		<?php echo $form->textField($user,'middlename',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'middlename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'lastname'); ?>
		<?php echo $form->textField($user,'lastname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'qualifier'); ?>
		<?php echo $form->textField($user,'qualifier',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'qualifier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'dob'); ?>
		<?php 
		// $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		// 	'model' => $user,
		// 	'attribute' => 'dob',
		// 	'options' => array(
		// 		'dateFormat' => 'yy-mm-dd',    // Match DB format
		// 		'changeMonth' => true,
		// 		'changeYear' => true,
		// 		'yearRange' => '1900:2025',    // Customize as needed
		// 	),
		// 	'htmlOptions' => array(
		// 		'size' => 20,
		// 		'maxlength' => 10,
		// 	),
		// ));
		?>
		<input type="date" name="User[dob]" />
		<?php echo $form->error($user,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'gender'); ?>
		<?php echo $form->textField($user,'gender',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'local_address'); ?>
		<?php echo $form->textField($user,'local_address',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'local_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user, 'region_id'); ?>
		<?php echo $form->dropDownList($user, 'region_id', $region, array(
			'prompt' => 'Select a region',
			'ajax' => array(
				'type' => 'POST',
				'url' => CController::createUrl('site/loadProvinces'),
				'update' => '#User_province_id',
			)
		)); ?>
		<?php echo $form->error($user, 'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user, 'province_id'); ?>
		<?php echo $form->dropDownList($user, 'province_id', array(), array(
			'prompt' => 'Select a province',
			'ajax' => array(
				'type' => 'POST',
				'url' => CController::createUrl('site/loadCities'),
				'update' => '#User_city_id',
			)
		)); ?>
		<?php echo $form->error($user, 'province_id'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($user,'city_id'); ?>
		<?php echo $form->dropDownList($user, 'city_id', array(), array(
			'prompt' => 'Select a city',
			'ajax' => array(
				'type' => 'POST',
				'url' => CController::createUrl('site/loadBarangays'),
				'update' => '#User_barangay_id',
			),
		)); ?>
		<?php echo $form->error($user,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'barangay_id'); ?>
		<?php echo $form->dropDownList($user, 'barangay_id', array(), array('prompt' => 'Select a barangay')); ?>
		<?php echo $form->error($user,'barangay_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'zip_code'); ?>
		<?php echo $form->textField($user,'zip_code',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'zip_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($account,'username'); ?>
		<?php echo $form->textField($account,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($account,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($account,'password'); ?>
		<?php echo $form->passwordField($account,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($account,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($account, 'department_id'); ?>
		<?php echo $form->dropDownList($account, 'department_id', $department, array('prompt' => 'Select a department')); ?>
		<?php echo $form->error($account, 'department_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($account, 'position_id'); ?>
		<?php echo $form->dropDownList($account, 'position_id', $position, array('prompt' => 'Select a position')); ?>
		<?php echo $form->error($account, 'position_id'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($account,'email_address'); ?>
		<?php echo $form->textField($account,'email_address',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($account,'email_address'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($account->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->