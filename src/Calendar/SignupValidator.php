<?php 
namespace Calendar;

use App\Validator;


class SignupValidator extends Validator {

    /*
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data) {
        parent::validates($data);
        $this->validate('name', 'minLength', 3);
        $this->validate('name', 'noNumber');
        $this->validate('firstname', 'minLength', 3);
        $this->validate('firstname', 'noNumber');
        $this->validate('email', 'isEmail');

        // get the password from data
        $this->validate('password', 'password');
        $this->validate('password_confirm', 'password_confirm');
        $this->validate('phone', 'number');
        $this->validate('phone', 'minLength', 10);
        
        $this->validate('business', 'minLength', 3);
        $this->validate('siret', 'number');
        $this->validate('siret', 'minLength', 14);
        $this->validate('address', 'minLength', 3);
       
        $this->validate('city', 'minLength', 3);
        $this->validate('postal_code', 'number');



       
        return $this->errors;
    }

}