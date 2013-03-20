<?php

/**
 * This is the model class for table "ingredient".
 *
 * The followings are the available columns in table 'ingredient':
 * @property string $id
 * @property string $name
 * @property string $unit_measurement
 * @property string $create_time
 * @property string $update_time
 * @property string $created_by
 * @property string $updated_by
 *
 * The followings are the available model relations:
 * @property BrewIngredient[] $brewIngredients
 * @property Grain[] $grains
 * @property Hop[] $hops
 * @property User $createdBy
 * @property User $updatedBy
 * @property LostIngredient[] $lostIngredients
 * @property RecipeIngredient[] $recipeIngredients
 */
class Ingredient extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ing the static model class
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
		return 'ingredient';
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
			array('name, unit_measurement', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, unit_measurement, create_time, update_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'brewIngredients' => array(self::HAS_MANY, 'BrewIngredient', 'ingredient_id'),
			'grain' => array(self::HAS_ONE, 'Grain', 'ingredient_id'),
			'hop' => array(self::HAS_ONE, 'Hop', 'ingredient_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
			'lostIngredients' => array(self::HAS_MANY, 'LostIngredient', 'ingredient_id'),
			'recipeIngredients' => array(self::HAS_MANY, 'RecipeIngredient', 'ingredient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'unit_measurement' => 'Unit Measurement',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('unit_measurement',$this->unit_measurement,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}