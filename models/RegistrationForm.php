<?php

namespace app\models;

class RegistrationForm extends  User
{
    public $confirm_password;
    public  $agree;

    public function rules()
    {
         $rules=parent::rules();
         array_push($rules,
         [[ 'confirm_password', 'agree'], 'required'],
         [['confirm_password'], 'compare', 'compareAttribute' => 'password'],
         [['agree'], 'compare', 'compareValue' => true, 'message' => ''],

         );

         return $rules;

    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Согласие с правилами использования',
    ];




 }

}