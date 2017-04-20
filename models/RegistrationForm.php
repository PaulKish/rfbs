<?php
namespace app\models;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    /**
     * @var string
     */
    public $role;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['roleRequired'] = ['role', 'required'];
        $rules['roleLength']   = ['role', 'string'];
        return $rules;
    }
}