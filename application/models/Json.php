<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/************************************
 * Class Json récupérée telle quelle, à ne pas modifier
 *************************************/
class Json extends CI_Model
{
	public static function getLastError($asString = FALSE)
	{
		$lastError = \json_last_error();

		if (!$asString) return $lastError;

		// Define the errors.
		$constants = \get_defined_constants(TRUE);
		$errorStrings = array();

		foreach ($constants["json"] as $name => $value)
			if (!strncmp($name, "JSON_ERROR_", 11))
				$errorStrings[$value] = $name;

		return isset($errorStrings[$lastError]) ? $errorStrings[$lastError] : FALSE;
	}

	public static function getLastErrorMessage()
	{
		return \json_last_error_msg();
	}

	public static function clean($jsonString)
	{
		if (!is_string($jsonString) || !$jsonString) return '';

		// Remove unsupported characters
		// Check http://www.php.net/chr for details
		for ($i = 0; $i <= 31; ++$i)
			$jsonString = str_replace(chr($i), "", $jsonString);

		$jsonString = str_replace(chr(127), "", $jsonString);

		// Remove the BOM (Byte Order Mark)
		// It's the most common that some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
		// Here we detect it and we remove it, basically it's the first 3 characters.
		if (0 === strpos(bin2hex($jsonString), 'efbbbf')) $jsonString = substr($jsonString, 3);

		return $jsonString;
	}

	public static function encode($value, $options = 0, $depth = 512)
	{
		return \json_encode($value, $options, $depth);
	}

	public static function decode($jsonString, $asArray = TRUE, $depth = 512, $options = JSON_BIGINT_AS_STRING)
	{
		if (!is_string($jsonString) || !$jsonString) return NULL;

		$result = \json_decode($jsonString, $asArray, $depth, $options);

		if ($result === NULL)
			switch (self::getLastError())
			{
				case JSON_ERROR_SYNTAX :
					// Try to clean json string if syntax error occured
					$jsonString = self::clean($jsonString);
					$result = \json_decode($jsonString, $asArray, $depth, $options);
					break;

				default:
					// Unsupported error
			}

		return $result;
	}
}
