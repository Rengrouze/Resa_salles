<?php
namespace Admin;

use App\Validator;

class AdminValidator extends Validator
{


    /*
     * @param array $data
     * @return array|bool 
     */

    public function validates(array $data)
    {
        parent::validates($data);






        return $this->errors;
    }

}