<?php 

class RegisterForm extends CFormModel
{
    public $email;
    public $password;
    public $confirmationPassword;
 
    public function rules()
    {
        return array(
            array('email, password, confirmationPassword', 'required'),
            array('email', 'email'),
            array('password', 'compare', 'compareAttribute' => 'confirmationPassword'),
        );
    }

    public function attributeLabels()
	{
		return array(
			'email' => 'E-mail',
			'password' => 'Пароль',
			'confirmationPassword' => 'Подтверждение пароля',
		);
	}
}