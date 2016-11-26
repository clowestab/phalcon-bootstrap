<?php

/**
 * Static descriptions are constants
 * Dynmic descriptions are functions
 */
class MetaDescription {

	/**
	 * This method renders the appropriate description
	 * Utilizing the passed data array as appropriate
	 */
	public static function render($name, $data = null) {

		if (defined("MetaDescription::" . $name)) {

			return constant("MetaDescription::" . $name);
		}

		$functionName    = strtolower($name);
		$functionName    = str_replace(' ', '', ucwords(str_replace('_', ' ', $functionName)));
		$functionName[0] = strtolower($functionName[0]);

		if (method_exists('MetaDescription', $functionName)) {

			return call_user_func(array("MetaDescription", $functionName), $data);
		}
	}
}