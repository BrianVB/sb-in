<?php

/**
 * This is the model class for table "hop".
 *
 * The followings are the available columns in table 'hop':
 * @property string $id
 * @property string $ingredient_id
 * @property string $alpha
 * @property string $beta
 * @property string $create_time
 * @property string $update_time
 * @property string $created_by
 * @property string $updated_by
 *
 * The followings are the available model relations:
 * @property BrewHop[] $brewHops
 * @property User $createdBy
 * @property Ingredient $ingredient
 * @property User $updatedBy
 */
class Hop extends Ingredient
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hop the static model class
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
		return 'hop';
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
			array('ingredient_id', 'numerical', 'integerOnly'=>true),
			array('alpha, beta', 'required'),
			array('alpha, beta', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ingredient_id, alpha, beta, create_time, update_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'brewHops' => array(self::HAS_MANY, 'BrewHop', 'hop_id'),
			'recipeHop' => array(self::HAS_MANY, 'RecipeHop', 'hop_id'),
			'ingredient' => array(self::BELONGS_TO, 'Ingredient', 'ingredient_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'alpha' => '% Alpha Acid',
			'beta' => '% Beta Acid',
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
		$criteria->compare('alpha',$this->alpha,true);
		$criteria->compare('beta',$this->beta,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}