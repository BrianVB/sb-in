<?php

class AssetController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$asset=new Asset;
		$ingredients = Ingredient::model()->findAll(array('order'=>'name'));

		if(isset($_POST['Asset'])){
			$asset->attributes=$_POST['Asset'];
			if($asset->save()){
				Yii::app()->user->setFlash('success', "Asset saved");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'asset'=>$asset,
			'ingredients'=>$ingredients,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$asset=$this->loadModel($id);
		$ingredients = Ingredient::model()->findAll(array('order'=>'name'));

		if(isset($_POST['Asset'])){
			$asset->attributes=$_POST['Asset'];
			if($asset->save()){
				Yii::app()->user->setFlash('success', "Asset updated");
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'asset'=>$asset,
			'ingredients'=>$ingredients,
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
			Yii::app()->user->setFlash('success', "Asset deleted");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$asset=new Asset('search');
		$asset->unsetAttributes();  // clear any default values
		if(isset($_GET['Asset']))
			$asset->attributes=$_GET['Asset'];

		$this->render('index',array(
			'asset'=>$asset,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Asset the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$asset=Asset::model()->findByPk($id);
		if($asset===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $asset;
	}
}
