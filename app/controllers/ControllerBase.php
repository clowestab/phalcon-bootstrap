<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {

    //an array of vars to set in the view
    protected $viewVars = array();


    public function onConstruct() {

    }


    public function beforeExecuteRoute() {

        $this->setJavascript("basic");
    }


    public function initialize() {

        $baseTitle = null;

        if (is_null($baseTitle)) {

            echo "Set your base title then delete this";
            die;
        }

        $this->tag->setTitle($baseTitle);    
    }


	function isSecure() {

      return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
    }


    public function getPageUrl() {

        $scheme = "https://";

        if (!$this->isSecure()) {
        	
            $scheme = "http://";
        }

        $pageUrl = "$scheme$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $pageUrl;
    }


    //Sets all the basic vars that available to all views
    public function afterExecuteRoute() {

        $isLoggedIn = true;
        
        $this->addViewVar('isLoggedIn', $isLoggedIn);

        $this->view->setVars($this->viewVars);
    }


    protected function addViewVar($variable, $value) {

        $this->viewVars[$variable] = $value;
    }


    //processes a response and returns it as json.. all endpoints should call this
    public function processJson($responseData) {

        $this->response->setContentType('application/json', 'UTF-8');

        $content = json_encode($responseData, JSON_PRETTY_PRINT);
        $this->response->setContent($content);
    }


    /**
     * Utility function for setting the Javascript file
     * that will be loaded in the view
     */
    protected function setJavascript($filePath) {

        $this->addViewVar("javascript", $filePath);
    }
}