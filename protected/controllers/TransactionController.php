<?php

class TransactionController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the page to handle inventory
	 */
	public function actionCreate()
	{
		$transaction=new Transaction;
		$line_items = array();

		if(isset($_POST['Transaction'])){
			$transaction->attributes=$_POST['Transaction'];
			if($transaction->save()){
				$success = true;
				foreach($_POST['LineItem'] as $line_item_data){
					$line_item = new LineItem;
					$line_item->transaction_id = $transaction->id;
					$line_item->attributes = $line_item_data;
					if(!$line_item->save()){
						$success = false;
					}
				}	
			} else {
				$success = false;
			}

			if($success){
				Yii::app()->user->setFlash('success', "Transaction saved");
				$this->redirect(array('inventory', 'id'=>$transaction->id));			
			}
		} 

		$line_items[] = new LineItem;

		$this->render('create',array(
			'transaction'=>$transaction,
			'line_items'=>$line_items,
		));
	}

	/**
	 * Handles creating assets after the transaction has been saved
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionInventory($id)
	{
		$transaction=Transaction::model()->with(array('lineItems','organization'))->findByPk($id);
		$line_items = $transaction->lineItems;
		$assets = array();

		if(isset($_POST['Asset'])){
			$success = true;
			foreach($_POST['Asset'] as $asset_data){
				$asset = new Asset;
				$asset->attribtues = $asset_data;
				if(!$asset->save()){
					$success = false;
				}
				$assets[] = $asset;
			}

			if($success){
				Yii::app()->user->setFlash('success', "Inventory saved");
				$this->redirect(array('index'));			
			}
		} 

		$this->render('inventory',array(
			'transaction'=>$transaction,
			'line_items'=>$line_items,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$transaction=Transaction::model()->with(array('lineItems','organization'))->findByPk($id);
		$line_items = $transaction->lineItems; // --- NOTE:: If we arrived here after submitting a transaction and deleting a line item, then that line item is deleted and not included at this point

		if(isset($_POST['Transaction'])){
			$transaction->attributes=$_POST['Transaction'];
			if($transaction->save()){
				$success = true;
				foreach($line_items as $line_item){
					$line_item->attributes = array_shift($_POST['LineItem']); // --- get the first element in the array. if we deleted one on the last page and got here again they should be in the $line_items variable in the same order as how we saved them on the transaction page
					if(!$line_item->save()){
						$success = false;
					}
				}	
			} else {
				$success = false;
			}

			if($success){
				Yii::app()->user->setFlash('success', "Transaction saved");
				$this->redirect(array('index'));			
			}	
		}

		$this->render('update',array(
			'transaction'=>$transaction,
			'line_items'=>$line_items,
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
	 * Adds a line item to the transaction form
	 */
	public function actionAddLineItem($index)
	{
		$this->renderPartial('_line_item_subform',array('index'=>$index,'line_item'=>new LineItem));
		Yii::app()->end();
	}

	/**
	 * Deletes a model for a line item
	 */
	public function actionDeleteLineItem($id)
	{
		LineItem::model()->findByPk($id)->delete();
		Yii::app()->end();
	}		

	/**
	 * Returns JSON data about previous line-items to help auto-fill data in a transaction with existing data
	 */
	public function actionAjaxGuessLineItem($term)
	{
		$result = Yii::app()->db->createCommand("SELECT * FROM line_item WHERE name like '%$term%' LIMIT 10");
		echo CJSON::encode($result);
		Yii::app()->end();
	}

	/**
	 * Returns JSON data about previous assets that have been saved to help auto-fill data about assets
	 */
	public function actionAjaxGuessIngredient($term)
	{
		$result = Yii::app()->db->createCommand("SELECT *, name as label FROM ingredient WHERE name like '%$term%' LIMIT 10")->queryAll();
		echo CJSON::encode($result);
		Yii::app()->end();
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
