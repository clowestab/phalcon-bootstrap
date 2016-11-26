<?php

class ModelBase extends \Phalcon\Mvc\Model {

    /**
     * Utility function that attempts to save a model to the database
     * If it does not save correctly, a PersistenceException is thrown
     * Some exception types can be explicitly ignored e.g the PDOException for duplicate entries
     */
    public function persistWithMessageLog($errorMessage, $errorCode, $ignoreCodes = null) {

        try {

            $result = $this->save();
            //print_r($this->getMessages()); die;

        } catch (PDOException $e) {

            //if we want to ignore certain errors.. e.g duplicates 
            if (is_null($ignoreCodes) || (!is_null($ignoreCodes) && !in_array($e->getCode(), $ignoreCodes))) {

                $message = "Error persisting " . get_class($this) . " (" . $e->getCode() . ")";
                $result  = false;
            }
        }

        if (!$result) {

            //print_r($this->getMessages());
            //die;
            
            throw new PersistenceException($errorMessage, $errorCode);
        }

        return true;
    }


    /**
     * Utility function that attempts to DELETE a model from the database
     * If it does not delete correctly, a PersistenceException is thrown
     */
    public function deleteWithMessageLog($errorMessage, $errorCode) {

        try {

            $result = $this->delete();

        } catch (PDOException $e) {

            $result = false;
        }

        if (!$result) {

            throw new PersistenceException($errorMessage, $errorCode);
        }

        return true;
    }
}