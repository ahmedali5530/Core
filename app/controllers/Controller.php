<?php
namespace App\Controllers;

use App\Core\Exceptions\NotFoundException;
use App\Core\Response\Response;
use App\Core\Response\JsonResponse;
use App\Core\Framework\Template;

class Controller{

	private $params = array();
	private $extension = '.php';
	public $defaultTemplateFolder;
	public $defaultTemplateFile;
	public $hasView = false;


	public function __construct(){
		$this->template = new Template();
		$this->defaultTemplateFolder = __CLASS__;
		$this->defaultTemplateFile = __METHOD__;
	}

	public function view($template = null, array $params = array()){

		$this->hasView = true;

		$parsedFile = $this->template->parse(VIEWPATH.$template);

		$this->template->setViewBag($params);

		return $this->template->loadParsedViewFile($parsedFile);

	}

	public function setData($key = array(), $val = null){

		$this->template->setViewBag($key, $val);

		return $this;
	}

	public function loadFile($file, $params){
		if (file_exists(VIEWPATH.$file.$this->extension)){
			// extract variables from the global scope:
			//extract($GLOBALS, EXTR_REFS);
			extract($params, EXTR_REFS);
			
			ob_start();
			require(VIEWPATH.$file);
			
			return ob_get_clean();
		} else
		{
			ob_clean();
			throw new NotFoundException("File ".VIEWPATH.$file.$this->extension." not found.");
		}
	}

	public function includeFile($file, $params){
		if (file_exists(VIEWPATH.$file.$this->extension)){
			// extract variables from the global scope:
			//extract($GLOBALS, EXTR_REFS);
			extract($params, EXTR_REFS);
			
			// ob_start();
			require(VIEWPATH.$file.self::$extension);
			
			// return ob_get_clean();
		} else
		{
			// ob_clean();
			throw new NotFoundException("File ".VIEWPATH.$file.$this->extension." not found.");
		}
	}

}