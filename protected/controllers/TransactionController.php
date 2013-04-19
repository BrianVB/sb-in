<?php

class TransactionController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
		$transaction=new Transaction;

		if(isset($_POST['Transaction'])){
			$transaction->attributes=$_POST['Transaction'];
			if($transaction->save()){
				Yii::app()->user->setFlash('success', "Transaction saved");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'transaction'=>$transaction,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$transaction=$this->loadModel($id);

		if(isset($_POST['Transaction'])){
			$transaction->attributes=$_POST['Transaction'];
			if($transaction->save()){
				Yii::app()->user->setFlash('success', "Transaction updated");
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'transaction'=>$transaction,
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
			Yii::app()->user->setFlash('success', "Transaction deleted");
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$transaction=new Transaction('search');
		$transaction->unsetAttributes();  // clear any default values
		if(isset($_GET['Transaction']))
			$transaction->attributes=$_GET['Transaction'];

		$this->render('index',array(
			'transaction'=>$transaction,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Transaction the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$transaction=Transaction::model()->findByPk($id);
		if($transaction===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $transaction;
	}
}
