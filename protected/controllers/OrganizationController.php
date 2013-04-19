<?php

class OrganizationController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$organization=new Organization;

		if(isset($_POST['Organization'])){
			$organization->attributes=$_POST['Organization'];
			if($organization->save()){
				Yii::app()->user->setFlash('success', "Organization saved");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'organization'=>$organization,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$organization=$this->loadModel($id);

		if(isset($_POST['Organization'])){
			$organization->attributes=$_POST['Organization'];
			if($organization->save()){
				Yii::app()->user->setFlash('success', "Organization updated");
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'organization'=>$organization,
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
		if(!isset($_GET['ajax'])){
			Yii::app()->user->setFlash('success', "Organization deleted");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$organization=new Organization('search');
		$organization->unsetAttributes();  // clear any default values
		if(isset($_GET['Organization']))
			$organization->attributes=$_GET['Organization'];

		$this->render('index',array(
			'organization'=>$organization,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Organization the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$organization=Organization::model()->findByPk($id);
		if($organization===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $organization;
	}
}
