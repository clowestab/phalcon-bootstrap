<?php

/**
 * Static titles are constants
 * Dynmic titles are functions
 */
class MetaTitle {

	/**
	 * This method renders the appropriate title
	 * Utilizing the passed data array as appropriate
	 */
	public static function render($name, $data = null) {

		if (defined("MetaTitle::" . $name)) {

			return constant("MetaTitle::" . $name);
		}

		$functionName    = strtolower($name);
		$functionName    = str_replace(' ', '', ucwords(str_replace('_', ' ', $functionName)));
		$functionName[0] = strtolower($functionName[0]);

		if (method_exists('MetaTitle', $functionName)) {

			return call_user_func(array("MetaTitle", $functionName), $data);
		}

		return null;
	}
}