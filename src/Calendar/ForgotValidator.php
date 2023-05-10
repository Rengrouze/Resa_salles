<?php
namespace Calendar;

use App\Validator;


class ForgotValidator extends Validator
{

    /*
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data)
    {
        parent::validates($data);
        $this->validate('email', 'isEmail');

        return $this->errors;
    }

}