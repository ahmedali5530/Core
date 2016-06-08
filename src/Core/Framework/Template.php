<?php
namespace App\Core\Framework;

use Closure;
use App\Core\Response\Response;
use App\Core\Exceptions\NotFoundException;

class Template{
	protected $extension = '.php';
	protected $viewBag = array();
	//in the views folder
	protected $storagePath = 'compiled';
	public $directives = array();


	/**
	 *	initilalize default directives
	 */
	public function __construct(){
		//general directive
		$this->addDirective('closing', function($string){
			//replace )@
			$string = str_replace(')@', '): ?>', $string);

			return $string;
		})->addDirective('if', function($string){
			//remove the @if(
			$string = str_replace('@if(', '<?php if(', $string);

			//remove the @elseif(
			$string = str_replace('@elseif(', '<?php elseif(', $string);

			//remove the @else
			$string = str_replace('@else@', '<?php else: ?>', $string);

			//remove the @endif
			$string = str_replace('@endif@', '<?php endif; ?>', $string);

			return $string;

		})->addDirective('echo', function($string){

			//replace {{
			$string = str_replace('{{', '<?php echo e(', $string);

			//now replace }}
			$string = str_replace('}}', '); ?>', $string);

			return $string;
		})->addDirective('foreach', function($string){
			//define directive
			//replace @foreach
			$string = str_replace('@foreach(', '<?php foreach(', $string);

			$string = str_replace('@endforeach@', '<?php endforeach; ?>', $string);

			return $string;
		})->addDirective('for', function($string){
			//replace @for
			$string = str_replace('@for(', '<?php for(', $string);

			$string = str_replace('@endfor@', '<?php endfor; ?>', $string);
			return $string;
		})->addDirective('while', function($string){

			$string = str_replace('@while(', '<?php while(', $string);
			$string = str_replace('@endwhile@', '<?php endwhile;?>', $string);

			return $string;
		})->addDirective('br', function($string){

			$string = str_replace('@br', '<br/>', $string);
			return $string;
		})->addDirective('var', function($string){
			$string = str_replace('{!', '<?php ', $string);
			$string = str_replace('!}', '; ?>', $string);
			return $string;
		});
	}

	/**
	 * add Directive
	 */
	public function addDirective($directiveName, Closure $function){
		$this->directives[$directiveName] = $function;
		return $this;
	}

	/**
	 * Get a Directive
	 */
	public function getDirective($directive){
		return $this->directives[$directive];
	}

	/**
	 * Get All Directives
	 */
	public function allDirectives(){
		return $this->directives;
	}

	/**
	 * Parse View File and apply directives
	 */
	public function parse($template){

		$fileName = $template;

		$contents = $this->getRawTemplateContents($template);

		//apply directives
		foreach($this->allDirectives() as $directive){
			$contents = $directive($contents);
		}

		//add new contents to the file and send back the filename
		$compiledFile = $this->generateTemplateName($fileName);

		$this->addTemplateToFile($compiledFile, $contents);

		//return compiled file with full path
		return VIEWPATH.$this->storagePath.DS.$compiledFile.$this->extension;
	}

	/**
	 * Get Raw data from original view file
	 */
	public function getRawTemplateContents($template){
		if(file_exists($template.$this->extension)){
			return file_get_contents($template.$this->extension);
		}else{
			throw new NotFoundException(sprintf('View "%s.php" not found', $template));
		}
	}

	/**
	 * add compiled contents to new file
	 */
	private function addTemplateToFile($name, $template){
		//create a directory if not found
		if(!is_file(VIEWPATH.$this->storagePath) && !file_exists(VIEWPATH.$this->storagePath)){
			mkdir(VIEWPATH.$this->storagePath);
		}
			
		file_put_contents(VIEWPATH.$this->storagePath.DS.$name.$this->extension, $template);
	}

	/**
	 * generate a name for compiled file
	 */
	private function generateTemplateName($templatePath){
		return md5($templatePath);
	}

	/**
	 * load the compiled file
	 */
	public function loadParsedViewFile($file){
		if(file_exists($file)){
			extract($this->getViewBag(), EXTR_REFS);
			
			ob_start();
			require($file);
			
			return ob_get_clean();
		}else{
			ob_clean();
			throw new NotFoundException("compiled File ".$file." not found.");
		}
	}

	/**
	 * set data to be sent along with view file
	 */
	public function setViewBag($key = array(), $val = null){
		if(func_num_args() === 0){
			return;
		}

		if(is_array($key) && $val === null){
			foreach($key as $a=>$b){
				$this->viewBag[$a] = $b;
			}

			return $this;
		}

		$this->viewBag[$key] = $val;

		return $this;
	}

	/**
	 * get view bag, all data to be sent to view
	 */
	public function getViewBag(){
		return $this->viewBag;
	}

}