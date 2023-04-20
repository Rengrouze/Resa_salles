<?php 
namespace Calendar;

use App\Validator;


class LoginValidator extends Validator {

    /*
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data) {
        parent::validates($data);
        $this->validate('email', 'isEmail');
        $this->validate('password', 'password');
        
     


       
        return $this->errors;
    }

}