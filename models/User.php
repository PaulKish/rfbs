<?php
namespace app\models;

/**
 *  Add role to user model
 */
class User extends \dektrium\user\models\User
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][]   = 'role';
        $scenarios['update'][]   = 'role';
        $scenarios['register'][] = 'role';
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['roleRequired'] = ['role', 'required'];
        $rules['roleLength']   = ['role', 'string'];
        
        return $rules;
    }
}