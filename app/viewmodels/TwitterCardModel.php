<?php

class TwitterCardModel {

	public $type;
	public $url;
	public $title;
	public $description;
	public $image;

	public $iPhoneLink;
	public $fbProfileId;


	public function __construct($type) {

		$this->type = $type;
	}


	public function getTitle() {

		return $this->title;
	}


	public function getUrl() {

		return $this->url;
	}


	public function getType() {

		return $this->type;
	}


	public function getImage() {

		return $this->image;
	}
}