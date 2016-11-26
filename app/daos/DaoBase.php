<?php
use \Phalcon\DiInterface;
use \Phalcon\DI\InjectionAwareInterface;

class DaoBase implements InjectionAwareInterface {

    protected $_di;

    public function setDi(DiInterface $di) {

        $this->_di = $di;
    }


    public function getDi() {

        return $this->_di;
    }


    public function __get($key) {

        $obj = $this->_di->get($key);
        
        if ($obj) { 
        
            return $obj;
        }
        
        return property_exists($this, $key) ? $this->$key : null;
    }
}