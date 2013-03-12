<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	// --- need to store the user's ID
	private $_id;
	
	const ERROR_NONE=0;
	const ERROR_USERNAME_PASSWORD_INVALID=1;
	const ERROR_ACCOUNT_INACTIVE=2;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// --- Check the username against the database
		$user = User::model()->findByAttributes(array('username'=>$this->username));
		if ($user===null || $user->password !== sha1($this->password.strtolower($this->username))){
			$this->errorCode=self::ERROR_USERNAME_PASSWORD_INVALID;
		} else {
			// --- Their credentials were correct but we need to do further checking based on account statuses
			if($user->active != 1){ // --- Account has been set to inactive
				$this->errorCode=self::ERROR_ACCOUNT_INACTIVE;
			} else {
				$this->errorCode=self::ERROR_NONE;
				$this->_id = $user->id;
			
				// -- Generate a random key for a cookie and to be stored in the database for extra security in authentication
				$user->login_key = $user->getKeyStr();
				$user->saveAttributes(array('login_key'=> $user->login_key));
				$this->setState('login_key', $user->login_key);
			}
		}
		return !$this->errorCode;
	}
	
	// --- Overrides the CUserIdentity class method which returns the username
	public function getId()
	{
		return $this->_id;
 	}
}