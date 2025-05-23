<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<h1>Create Account</h1>

<?php $this->renderPartial('_form', array(
	'account'=>$account,
	'user'=>$user,
	'barangay'=>$barangay,
	'city'=>$city,
	'province'=>$province,
	'region'=>$region,
	'department'=>$department,
	'position'=>$position,
	)); ?>