<?php 

class ServiceException extends Exception {

	private $identifier;

    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {

        // call the parent to save values
        parent::__construct($message, $code, $previous);
    }    


    public function setIdentifier($identifier) {

    	$this->identifier = $identifier;
    }


    public function getAsArray() {

        $returnArray = array("message" => $this->getMessage(), "code" => $this->getCode());

        if ($this->identifier) {
            
        	$returnArray["identifier"] = $this->identifier;
        }

        return $returnArray;
    }
}