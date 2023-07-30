<?php

namespace app\models;

use Symfony\Component\VarDumper\VarDumper;
use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $login;
    public $password;
    public $password_repeat;
    public $rules;
    
   

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'login', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'login', 'password', 'password_repeat'], 'string', 'max' => 255],
            ['rules','required','requiredValue' => 1, 'message' => 'Нужно потвердить согласие rules'],
            ['email', 'email'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            // [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яА-ЯёЁ\-\s]*$/u'],
            // ['login', 'match', 'pattern' => '/[a-zA-Z0-9-]*$/'],
            ['patronymic', 'default', 'value' => null],
        ];
    }

   

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */


    public function registerUser()
    {
        if($this->validate()) {
            $user = new User();
            
            if($user->load($this->attributes, '') ) {
    
                if (!$user -> save(false)) {
                    // VarDumper::dump($user->errors);
                    // die;
                    
                }

            }

        
        } else {
            // VarDumper::dump($this->errors);
            // die;
            
        }

        return $user ? $user : false; 
        
    }
}
