<?php
namespace App\Core\Utils;

class Array {

	public $delimiter = '.';

	/**
	 * @param string $delimiter
	 * @return Array
	 */
	public function setDelimiter($delimiter){
		$this->delimiter = $delimiter;
		return $this;
	}

	/**
	 * @return string $delimiter
	 */
	public function getDelimiter(){
		return $this->delimiter;
	}

	/**
	 * @param string $string
	 * @return array
	 */
	public function explodeString($string){
		$array = explode($this->getDelimiter(), $string);

		return $array;
	}

}