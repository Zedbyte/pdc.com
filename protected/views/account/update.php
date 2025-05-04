<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$account->id=>array('view','id'=>$account->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Create Account', 'url'=>array('create')),
	array('label'=>'View Account', 'url'=>array('view', 'id'=>$account->id)),
	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<h1>Update Account <?php echo $account->id; ?></h1>

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