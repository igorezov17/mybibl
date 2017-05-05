<?php

class UserIdentity extends CUserIdentity
{
	private $_id;
	private $isLogin = false;
	private $permission = 0;

    public function authenticate() {
        $record = Users::model()->findByAttributes(array('email' => $this->username));

        if ($record === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if (md5($this->username.'+'.$this->password) != $record->public_key) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
        else {	
            $this->_id = $record->id;
			$this->isLogin = true;
			$this->permission = $record->permission;

			$this->setState('name', $record->email);
			$this->setState('permission', $this->isAdmin());
			
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

	public function getId() {
        return $this->_id;
    }

	public function isAdmin() {
		return $this->isLogin ? $this->permission == 1 : false;
	}
}