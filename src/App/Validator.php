<?php
namespace App;

class Validator {

    private $data;
    protected $errors =[];

public function __construct(array $data = []) {
        $this->data = $data;

}

    /**
 * @param array $data
 * @return array|bool
 */

 public function validates(array $data) {
    $this->errors = [];
    $this->data = $data;
    return $this->errors;
}

    public function validate(string $field, string $method, ...$parameters) {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "Le champs $field n'est pas rempli";
            return false;
        } else {
            return call_user_func([$this, $method], $field, ...$parameters);
        }
    }
    public function minLength(string $field, int $length) : bool {
        if (strlen($this->data[$field]) < $length) {
            $this->errors[$field] = "Le champs $field doit contenir au moins $length caractères";
            return false;
        }
        return true;
    }
    public function date (string $field) : bool {
        $date = \DateTime::createFromFormat('Y-m-d', $this->data[$field]);
        if ($date === false) {
            $this->errors[$field] = "$field n'est pas une date valide";
            return false;
        }
        return true;
    }
    public function time (string $field) : bool {
        $date = \DateTime::createFromFormat('H:i', $this->data[$field]);
        if ($date === false) {
            $this->errors[$field] = "$field n'est pas une date valide";
            return false;
        }
        return true;
    }
    public function beforeTime (string $startField, string $endField){
        if ($this->time($startField)&& $this->time($endField)) {
            $start = \DateTime::createFromFormat('H:i', $this->data[$startField]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endField]);
            if ($start->getTimestamp() > $end->getTimestamp()) {
                $this->errors[$startField] = "L'heure de début doit être antérieure à l'heure de fin";
                return false;
            }
            return true;
        }
        return false;
    }


    // check if the mail is correct
    public function isEmail(string $field) : bool {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "$field n'est pas un email valide";
            return false;
        }
        return true;
    }

    // check if there is numbers in the field
    public function number(string $field) : bool {
        if (!is_numeric($this->data[$field])) {
            $this->errors[$field] = "$field doit être un nombre";
            return false;
        }
        return true;
    }
    // check if there is numbers in the field, if yes send an error
    public function noNumber(string $field) : bool {
        if (is_numeric($this->data[$field])) {
            $this->errors[$field] = "$field ne doit pas contenir de chiffres";
            return false;
        }
        return true;
    }
    // check if password is strong, 8 character, 1 number, 1 uppercase, 1 lowercase, if not send an error
    public function password(string $field) : bool {

       
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',$this->data[$field])) {
            $this->errors[$field] = "Le champ $field doit contenir au moins 8 caractères, dont au moins une lettre minuscule, une lettre majuscule et un chiffre.";
            return false;
        }
        return true;
    }
    
    
    // password confirmation
    public function password_confirm(string $field) : bool {
        if ($this->data[$field] !== $this->data['password']) {
            $this->errors[$field] = "Les mots de passe ne correspondent pas";
            return false;
        }
        return true;
    }

    //prevent SQL injection
    public function noSql(string $field) : bool {
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $this->data[$field])) {
    $this->errors[$field] = "Le champ $field ne doit pas contenir de caractères spéciaux";
    return false;
    }
    return true;
    }


    }