<?php

class IngredientController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$ingredient=new Ingredient;

		if(isset($_POST['Ingredient'])){
			$ingredient->attributes=$_POST['Ingredient'];
			if($ingredient->save()){
				Yii::app()->user->setFlash('success', "Ingredient saved");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'ingredient'=>$ingredient,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$ingredient=$this->loadModel($id);

		if(isset($_POST['Ingredient'])){
			$ingredient->attributes=$_POST['Ingredient'];
			if($ingredient->save()){
				Yii::app()->user->setFlash('success', "Ingredient updated");
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'ingredient'=>$ingredient,
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
			Yii::app()->user->setFlash('success', "Ingredient deleted");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$ingredient=new Ingredient('search');
		$ingredient->unsetAttributes();  // clear any default values
		if(isset($_GET['Ingredient']))
			$ingredient->attributes=$_GET['Ingredient'];

		$this->render('index',array(
			'ingredient'=>$ingredient,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ingredient the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$ingredient=Ingredient::model()->findByPk($id);
		if($ingredient===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $ingredient;
	}
}
