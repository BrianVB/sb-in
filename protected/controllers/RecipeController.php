<?php

class RecipeController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$recipe=new Recipe;

		if(isset($_POST['Recipe'])){
			$recipe->attributes=$_POST['Recipe'];
			if($recipe->save()){
				Yii::app()->user->setFlash('success', "Recipe saved");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'recipe'=>$recipe,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$recipe=$this->loadModel($id);

		if(isset($_POST['Recipe'])){
			$recipe->attributes=$_POST['Recipe'];
			if($recipe->save()){
				Yii::app()->user->setFlash('success', "Recipe updated");
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'recipe'=>$recipe,
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
			Yii::app()->user->setFlash('success', "Recipe deleted");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$recipe=new Recipe('search');
		$recipe->unsetAttributes();  // clear any default values
		if(isset($_GET['Recipe']))
			$recipe->attributes=$_GET['Recipe'];

		$this->render('index',array(
			'recipe'=>$recipe,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Recipe the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$recipe=Recipe::model()->findByPk($id);
		if($recipe===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $recipe;
	}
}
