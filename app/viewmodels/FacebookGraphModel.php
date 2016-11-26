<?php

class FacebookGraphModel {

	public $type;
	public $url;
	public $title;
	public $description;
	public $image;

	public $iPhoneLink;
	public $fbProfileId;

	public $customProperties = array();

	public $androidUrl;
	public $iosUrl;

	public function __construct($title, $url, $type = null) {

		$this->title = $title;
		$this->url   = $url;

		if (!is_null($type)) {

			$this->type = $type;
		}
	}


	public function getTitle() {

		return $this->title;
	}


	public function getDescription() {

		return $this->description;
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


	public function setCustomProperty($key, $value) {

		$this->customProperties[$key] = $value;
	}


	public function getCustomProperties() {

		return $this->customProperties;
	}


	public function setAndroidUrl($androidUrl) {

		$this->androidUrl = $androidUrl;
	}


	public function getAndroidUrl() {

		return $this->androidUrl;
	}


	public function setIosUrl($iosUrl) {

		$this->iosUrl = $iosUrl;
	}


	public function getIosUrl() {

		return $this->iosUrl;
	}
}