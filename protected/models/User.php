<?php
class User extends CActiveRecord
{
	/**
	 * @var UserIdentity for the logged in user
	 */
	private $_identity;

	/**
	 *	@var bool whether or not to set a cookie to remember the user is logged in
	 */
	public $remember_me;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
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
			array('username, password', 'required', 'on'=>'login'),
			array('remember_me', 'boolean'),
			array('password', 'authenticate', 'on'=>'login'),

			array('first_name, last_name, username, password', 'required', 'on'=>'create'),
			array('first_name, last_name, email', 'length', 'max'=>45),
			array('username', 'length', 'max'=>25),
			array('password', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, email, username, password, create_time, update_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'authItems' => array(self::MANY_MANY, 'AuthItem', 'AuthAssignment(user_id, itemname)'),
			'assets_created' => array(self::HAS_MANY, 'Asset', 'created_by'),
			'assets_last_updated' => array(self::HAS_MANY, 'Asset', 'updated_by'),
			'brews_created' => array(self::HAS_MANY, 'Brew', 'created_by'),
			'brews_last_updated' => array(self::HAS_MANY, 'Brew', 'updated_by'),
			'grains_created' => array(self::HAS_MANY, 'Grain', 'created_by'),
			'grains_last_updated' => array(self::HAS_MANY, 'Grain', 'updated_by'),
			'hops_created' => array(self::HAS_MANY, 'Hop', 'created_by'),
			'hops_last_updated' => array(self::HAS_MANY, 'Hop', 'updated_by'),
			'ingredients_created' => array(self::HAS_MANY, 'Ingredient', 'created_by'),
			'ingredients_last_updated' => array(self::HAS_MANY, 'Ingredient', 'updated_by'),
			'lineItems_created' => array(self::HAS_MANY, 'LineItem', 'created_by'),
			'lineItems_last_updated' => array(self::HAS_MANY, 'LineItem', 'updated_by'),
			'lostIngredients_created' => array(self::HAS_MANY, 'LostIngredient', 'created_by'),
			'lostIngredients_last_updated' => array(self::HAS_MANY, 'LostIngredient', 'update_by'),
			'organizations_created' => array(self::HAS_MANY, 'Organization', 'created_by'),
			'organizations_last_updated' => array(self::HAS_MANY, 'Organization', 'update_by'),
			'recipes_created' => array(self::HAS_MANY, 'Recipe', 'created_by'),
			'recipes_last_updated' => array(self::HAS_MANY, 'Recipe', 'updated_by'),
			'recipeIngredients_created' => array(self::HAS_MANY, 'RecipeIngredient', 'created_by'),
			'recipeIngredients_last_updated' => array(self::HAS_MANY, 'RecipeIngredient', 'updated_by'),
			'transactions_created' => array(self::HAS_MANY, 'Transaction', 'created_by'),
			'transactions_last_updated' => array(self::HAS_MANY, 'Transaction', 'updated_by'),
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Salt and encrypt the password before we save it
	 */
	public function encryptPassword() {
		$this->password = sha1($this->password . strtolower($this->username));	
	}


	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate()){
				// --- display a different error message to the users based on the error
				switch($this->_identity->errorCode){
					case CBaseUserIdentity::ERROR_USERNAME_INVALID :
					case CBaseUserIdentity::ERROR_PASSWORD_INVALID :
						$this->addError('password','Incorrect username or password.');
						break;
					case CBaseUserIdentity::ERROR_ACCOUNT_INACTIVE:
						$this->addError('active','You account has been deactivated.');
						break;
				}
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null){
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}

		if($this->_identity->errorCode===UserIdentity::ERROR_NONE){
			$duration=$this->remember_me ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		} else {
			return false;
		}
	}
}