<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class SbWebUser extends CWebUser 
{
	/**
	 * This method is called before logging in a user.
	 * You may override this method to provide additional security check.
	 * For example, when the login is cookie-based, you may want to verify
	 * that the user ID together with a random token in the states can be found
	 * in the database. This will prevent hackers from faking arbitrary
	 * identity cookies even if they crack down the server private key.
	 * @param mixed $id the user ID. This is the same as returned by {@link getId()}.
	 * @param array $states a set of name-value pairs that are provided by the user identity.
	 * @param boolean $fromCookie whether the login is based on cookie
	 * @return boolean whether the user should be logged in
	 * @since 1.1.3
	 */
	protected function beforeLogin($id,$states,$fromCookie)
	{
		// --- If they are authenticating from using a cookie validate it against their login key in the database
		if($fromCookie){
			$login_key_cookie = Yii::app()->request->cookies['login_key'];
			$user = User::model()->findByAttributes(array('id'=>$id));		
			if(!$login_key_cookie || $login_key_cookie->value != $user->login_key){
				return false;	
			}
		}
		return true;
	}

	/**
	 * This method is called after the user is successfully logged in.
	 * You may override this method to do some postprocessing (e.g. log the user
	 * login IP and time; load the user permission information).
	 * @param boolean $fromCookie whether the login is based on cookie.
	 * @since 1.1.3
	 */
	protected function afterLogin($fromCookie)
	{
		$user = User::model()->findByAttributes(array('id'=>$this->id));

		if($user){
			// --- Save the current time as the last login time for the user
			$user->last_login= new CDbExpression('NOW()');
			$user->login_key = SbLib::getKeyStr();
			$user->save();
			
			// --- Check for necessary cookies
			$login_key_cookie = new CHttpCookie('login_key', $user->login_key);
			$login_key_cookie->value = $user->login_key;
			$login_key_cookie->expire = time()+60*60*24*30;
			Yii::app()->request->cookies['login_key'] = $login_key_cookie;
		}
	}
}