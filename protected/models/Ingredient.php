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
	 * Constants for the ingredient types since they are tinyint() in the database
	 */
	const TYPE_GRAIN = 10;
	const TYPE_HOP = 11;
	const TYPE_YEAST = 12;
	const TYPE_OTHER = 13;

	/**
	 * @var int The type that the grain was to being with. This is used so we can see if it changed when we are updating, and delete other related records;
	 */
	public $starting_type;

	/**
	 * @var string These variables are used when searching for grains to search by their subtype attributes
	 */
	public $alpha_search, $beta_search, $lovibond_search;


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
			array('name, type', 'required'),
			array('name', 'length', 'max'=>45),
			array('type', 'in', 'range'=>array(self::TYPE_GRAIN,self::TYPE_HOP,self::TYPE_YEAST,self::TYPE_OTHER)),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, lovibond_search, alpha_search, beta_search, create_time, update_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'lovibond_search' => '&deg; Lovibond',
			'alpha_search' => '% Alpha Acid',
			'beta_search' => '% Beta Acid',
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
		$criteria->with = array('grain','hop');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('grain.lovibond',$this->lovibond_search,true);
		$criteria->compare('hop.alpha',$this->alpha_search,true);
		$criteria->compare('hop.beta',$this->beta_search,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of ingredient types for dropdowns
	 * @return array of ingredient types
	 */
	public function getTypeList()
	{
		return array(
			self::TYPE_GRAIN=>'Grain',
			self::TYPE_HOP=>'Hop',
			self::TYPE_YEAST=>'Yeast',
			self::TYPE_OTHER=>'Other',
		);
	}

	/**
	 * Checks if the ingredient type changed during an update and deletes the old related record if it did
	 * @return array of ingredient types
	 */
	public function cleanIfNecessary()
	{
		if($this->starting_type != $this->type){
			if($this->starting_type == self::TYPE_GRAIN){
				$this->grain->delete();
			} else if($this->starting_type == self::TYPE_HOP){
				$this->hop->delete();
			}
		}
	}

	/**
	 * Since the type is stored as an integer and we are using constants, we use this as a shortcut to get the type name
	 * @return string Name of the type 
	 */
	public function getTypeName()
	{
		switch($this->type){
			case self::TYPE_GRAIN:
				return 'Grain';
			case self::TYPE_HOP:
				return 'Hop';
			case self::TYPE_YEAST:
				return 'Yeast';
			case self::TYPE_OTHER:
				return 'Other';
		}
	}

	/**
	 * Since the type is stored as an integer and we are using constants, we use this as a shortcut to get the type name
	 * @return string Name of the type 
	 */
	public function getFullName()
	{
		switch($this->type){
			case self::TYPE_GRAIN:
				return $this->name.' '.$this->grain->lovibond;
			case self::TYPE_HOP:
				return $this->name.' '.$this->hop->alhpa.'%alpha '.$this->hop->beta.'%beta';
			default:
				return $this->name;
		}
	}	
}