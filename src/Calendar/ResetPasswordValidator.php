<?php
namespace Calendar;

use App\Validator;

class ResetPasswordValidator extends Validator
{


    /*
     * @param array $data
     * @return array|bool
     */

    public function validates(array $data)
    {
        parent::validates($data);
        $this->validate('new_password', 'password');




        return $this->errors;
    }

}