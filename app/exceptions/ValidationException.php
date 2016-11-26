<?php 

/**
 * Exception thrown when there is an issue validating
 * the inputs of a specific request
 */
class ValidationException extends ServiceException {

    private $errors = array();


    public function addError($field, $message) {

        $this->errors[$field] = $message;
    }


    public function getErrors() {

        return $this->errors;
    }


    public function getAsArray() {
        
        $result           = parent::getAsArray();
        $result['type']   = 'validation';
        $result["fields"] = $this->getErrors();
        
        return $result;
    }
}