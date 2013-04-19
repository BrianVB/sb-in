<?php

/**
 * This is the model class for table "grain".
 *
 * The followings are the available columns in table 'grain':
 * @property string $id
 * @property string $ingredient_id
 * @property integer $lovibond
 * @property string $create_time
 * @property string $update_time
 * @property string $created_by
 * @property string $updated_by
 *
 * The followings are the available model relations:
 * @property BrewGrain[] $brewGrains
 * @property User $createdBy
 * @property Ingredient $ingredient
 * @property User $updatedBy
 * @property RecipeGrain[] $recipeGrains
 */
class Grain extends Ingredient
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Grain the static model class
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
		return 'grain';
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
			array('lovibond', 'type', 'type'=>'float', 'allowEmpty'=>false),
			array('ingredient_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ingredient_id, lovibond, create_time, update_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'brewGrains' => array(self::HAS_MANY, 'BrewGrain', 'grain_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'ingredient' => array(self::BELONGS_TO, 'Ingredient', 'ingredient_id'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
			'recipeGrains' => array(self::HAS_MANY, 'RecipeGrain', 'grain_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ingredient_id' => 'Ingredient',
			'lovibond' => '&deg; Lovibond',
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
		$criteria->compare('ingredient_id',$this->ingredient_id,true);
		$criteria->compare('lovibond',$this->lovibond);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}