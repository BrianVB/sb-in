<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$<?php echo $this->getModelVariableName(); ?>=new <?php echo $this->modelClass; ?>;

		if(isset($_POST['<?php echo $this->modelClass; ?>'])){
			$<?php echo $this->getModelVariableName(); ?>->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($<?php echo $this->getModelVariableName(); ?>->save()){
				Yii::app()->user->setFlash('success', "<?php echo $this->getModelClass(); ?> saved");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'<?php echo $this->getModelVariableName(); ?>'=>$<?php echo $this->getModelVariableName(); ?>,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$<?php echo $this->getModelVariableName(); ?>=$this->loadModel($id);

		if(isset($_POST['<?php echo $this->modelClass; ?>'])){
			$<?php echo $this->getModelVariableName(); ?>->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($<?php echo $this->getModelVariableName(); ?>->save()){
				Yii::app()->user->setFlash('success', "<?php echo $this->getModelClass(); ?> updated");
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'<?php echo $this->getModelVariableName(); ?>'=>$<?php echo $this->getModelVariableName(); ?>,
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
			Yii::app()->user->setFlash('success', "<?php echo $this->getModelClass(); ?> deleted");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$<?php echo $this->getModelVariableName(); ?>=new <?php echo $this->modelClass; ?>('search');
		$<?php echo $this->getModelVariableName(); ?>->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$<?php echo $this->getModelVariableName(); ?>->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('index',array(
			'<?php echo $this->getModelVariableName(); ?>'=>$<?php echo $this->getModelVariableName(); ?>,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return <?php echo $this->modelClass; ?> the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$<?php echo $this->getModelVariableName(); ?>=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($<?php echo $this->getModelVariableName(); ?>===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $<?php echo $this->getModelVariableName(); ?>;
	}
}
