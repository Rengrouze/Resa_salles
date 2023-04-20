<?php
namespace Calendar;

use App\Validator;

class EventValidator extends Validator {


 /*
    * @param array $data
    * @return array|bool
    */
    
public function validates (array $data){
    parent::validates($data);
    $this->validate('idClient', 'number');
    $this->validate('numberOfDays', 'number');
  
    $this->validate('totalPrice', 'number');
    


    return $this->errors;
}

}