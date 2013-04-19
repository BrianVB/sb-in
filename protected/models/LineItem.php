<?php

/**
 * This is the model class for table "line_item".
 *
 * The followings are the available columns in table 'line_item':
 * @property string $id
 * @property string $transaction_id
 * @property string $asset_id
 * @property integer $quantity
 * @property string $unit_price
 * @property string $create_time
 * @property string $update_time
 * @property string $created_by
 * @property string $updated_by
 *
 * The followings are the available model relations:
 * @property Asset $asset
 * @property User $createdBy
 * @property User $updatedBy
 * @property Transaction $transaction
 */
class LineItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LineItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'line_item';
	}

	/**
	 * @return a list of behaviors associated with this model
	 */
    public function behaviors() {
        return array(            
            'SavedByBehavior' => array(
                'class' => 'ext.behaviors.SavedByBehavior',
            ),
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantity', 'numerical', 'integerOnly'=>true),
			array('transaction_id, asset_id, unit_price', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, transaction_id, asset_id, quantity, unit_price, create_time, update_time, created_by, updated_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'asset' => array(self::BELONGS_TO, 'Asset', 'asset_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
			'transaction' => array(self::BELONGS_TO, 'Transaction', 'transaction_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction_id' => 'Transaction',
			'asset_id' => 'Asset',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('asset_id',$this->asset_id,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}