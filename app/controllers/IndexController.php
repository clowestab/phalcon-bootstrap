<?php

/**
 * @RoutePrefix("/")
 * Index controller
 */
class IndexController extends ControllerBase {
	
    /**
     * @Get("/")
     */
	public function indexAction() {

        //set the meta data
        $this->tag->prependTitle(MetaTitle::render('INDEX'));
        $this->mtag->setMetaDescription(MetaDescription::render('INDEX'));

        $this->setJavascript("index");

        $this->view->pick("index");
    }
}