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
		$hop = new Hop;
		$grain = new Grain;

		if(isset($_POST['Ingredient'])){
			$ingredient->attributes=$_POST['Ingredient'];
			$success = $ingredient->validate();

			if($ingredient->type == Ingredient::TYPE_HOP){
				$hop->ingredient_id=$ingredient->id;
				$hop->attributes = $_POST['Hop'];
				if($success = $hop->validate() && $success){
					$ingredient->save();
					$hop->save();
				}
			} else if($ingredient->type == Ingredient::TYPE_GRAIN){
				$grain->ingredient_id=$ingredient->id;
				$grain->attributes = $_POST['Grain'];					
				if($success = $grain->validate() && $success){
					$ingredient->save();
					$grain->save();
				}
			} else if($success){
				$ingredient->save();
			}

			if($success){
				Yii::app()->user->setFlash('success', "Ingredient saved");		
				$this->redirect(array('index'));				
			}
		}

		$this->render('create',array(
			'ingredient'=>$ingredient,
			'hop'=>$hop,
			'grain'=>$grain,
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
		
		if($hop = $ingredient->hop){
			$grain = new Grain;
		} else if($grain = $ingredient->grain){
			$hop = new Hop;
		} else {
			$grain = new Grain;
			$hop = new Hop;
		}

		if(isset($_POST['Ingredient'])){
			$ingredient->starting_type = $ingredient->type; // --- So we can see if it changed
			$ingredient->attributes=$_POST['Ingredient'];
			$success = $ingredient->validate();

			if($ingredient->type == Ingredient::TYPE_HOP){
				$hop->ingredient_id=$ingredient->id;
				$hop->attributes = $_POST['Hop'];
				if($success = $hop->validate() && $success){
					$ingredient->save();
					$hop->save();
				}
			} else if($ingredient->type == Ingredient::TYPE_GRAIN){
				$grain->ingredient_id=$ingredient->id;
				$grain->attributes = $_POST['Grain'];					
				if($success = $grain->validate() && $success){
					$ingredient->save();
					$hop->save();
				}
			} else if($success){
				$ingredient->save();
			}

			if($success){
				$ingredient->cleanIfNecessary();
				Yii::app()->user->setFlash('success', "Ingredient saved");		
				$this->redirect(array('index'));				
			}			
		}

		$this->render('update',array(
			'ingredient'=>$ingredient,
			'hop'=>$hop,
			'grain'=>$grain,
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
