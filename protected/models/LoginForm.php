<?php 

class LoginForm extends CFormModel
{
    public $email;
    public $password;
 
    private $_identity;
 
    public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('password', 'authenticate'),
        );
    }
 
    public function authenticate($attribute, $params)
    {
        $this->_identity = new UserIdentity($this->email, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password','Неправильное имя пользователя или пароль.');
    }
}