<?php

class AccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$account = new Account;
		$user = new User;
		$barangay = CHtml::listData(Barangay::model()->findAll(), 'barangay_id', 'barangay_name');
		$city = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
		$province = CHtml::listData(Province::model()->findAll(), 'province_id', 'province_name');
		$region = CHTml::listData(Region::model()->findAll(), 'region_id', 'region_name');

		$department = CHtml::listData(Department::model()->findAll(), 'id', 'department_name');
		$position = CHtml::listData(Position::model()->findAll(), 'id', 'position_name');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$account->attributes=$_POST['Account'];
			$account->account_type = 1;
			$user->attributes=$_POST['User'];
			// var_dump($account->attributes);exit;
			if($account->save())
			{	
				$user->account_id = $account->id;
				$user->save();
				$this->redirect(array('view','id'=>$account->id));
			}
			else {
				var_dump($account->getErrors());
			}
		}

		$this->render('create',array(
			'account'=>$account,
			'user'=>$user,
			'barangay'=>$barangay,
			'city'=>$city,
			'province'=>$province,
			'region'=>$region,
			'department'=>$department,
			'position'=>$position,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$account = $this->loadModel($id); // Fixed
		$user = User::model()->findByAttributes(array('account_id' => $id));
	
		// Load dropdowns (reuse same as in create)
		$barangay = CHtml::listData(Barangay::model()->findAll(), 'barangay_id', 'barangay_name');
		$city = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
		$province = CHtml::listData(Province::model()->findAll(), 'province_id', 'province_name');
		$region = CHtml::listData(Region::model()->findAll(), 'region_id', 'region_name');
		$department = CHtml::listData(Department::model()->findAll(), 'id', 'department_name');
		$position = CHtml::listData(Position::model()->findAll(), 'id', 'position_name');
	
		if (isset($_POST['Account']) && isset($_POST['User'])) {
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
	
			if ($account->save() && $user->save()) {
				$this->redirect(array('view', 'id' => $account->id));
			}
		}
	
		$this->render('update', array(
			'account' => $account,
			'user' => $user,
			'barangay' => $barangay,
			'city' => $city,
			'province' => $province,
			'region' => $region,
			'department' => $department,
			'position' => $position,
		));
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Account');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
