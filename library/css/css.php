<?php

/**
 * @package     Legado
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     License: Massachusetts Institute of Technology. See license.txt
 */
defined('LEGADO_BASE') or die('Direct access denied');

class LegadoCSS {
	
	/**
	 *
	 * @var Array 
	 */
	private $browser = array();
	
	/**
	 *
	 * @var String 
	 */
	private $content;
	
	/**
	 *
	 * @var String 
	 */
	private $dictionary = null;
	
	
	/**
	 * Base live URL of where this librady is, or, at least, where public files
	 * are.
	 * 
	 * @var String Default '' for base of site 
	 */
	private $baseurl = '';
	
	/**
	 * Value that must have before the propetie to allow
	 * 
	 * @var String 
	 */
	protected $prefix = "\t";
	
	/**
	 * @var String
	 */
	protected $result = '';

	/**
	 * 
	 */
	public function __construct() {
		//
	}

	/**
	 * Method to debug one class from inside
	 * 
	 * @see github.com/fititnt/php-snippet/tree/master/dump
	 * 
	 * @param array $option Whoe function must work
	 * 						$option['method'] = 'default':
	 * 							Return simple print_r() inside <pre>
	 * 						$option['method'] = 'console':
	 * 							Return values on javascript console of browsers
	 * 						$option['die'] = 1:
	 * 							If excecution must stop after excecution
	 * 
	 * @return Object $this Suport for method chaining
	 */
	public function debug($option = array()) {
		if (!isset($option['method'])) {
			$option['method'] = 'default';
		}
		switch ($option['method']) {
			case 'console':
				$html = array();
				$date = date("Y-m-d h:i:s");
				$html[] = '<script>';
				$html[] = 'console.groupCollapsed("' . __CLASS__ . ':' . $date . '");';
				//@todo: add separed group (fititnt, 2012-02-15 02:03)
				$html[] = 'console.groupCollapsed("$this");';
				$html[] = 'console.dir(eval(' . json_encode($this) . '));'; //evail is evil... And?
				$html[] = 'console.groupEnd()';
				$html[] = 'console.groupEnd()';
				$html[] = '</script>';
				echo implode(PHP_EOL, $html);
				break;
			case 'default':
			default:
				echo '<pre>';
				print_r($this);
				echo '</pre>';
				break;
		}
		if (isset($option['die'])) {
			die;
		}
		return $this;
	}

	/**
	 * Delete (set to NULL) generic variable
	 * 
	 * @param String $name: name of var do delete
	 * @return Object $this Suport for method chaining
	 */
	public function del($name) {
		$this->$name = NULL;
		return $this;
	}

	/**
	 * Return generic variable
	 * 
	 * @param String $name: name of var to return
	 * @return Mixed this->$name: value of var
	 */
	public function get($name) {
		return $this->$name;
	}
	
	/**
	 * Return parsed content
	 * 
	 * @return Mixed this->$name: value of var
	 */
	public function getContent() {
		$this->loadDictionary();
		
		
		
		if (is_array($this->browser)) {
			foreach ($this->browser AS $browser) {
				$this->result = preg_replace($this->dictionary[$browser]['in'], $this->dictionary[$browser]['out'], $this->content);
			}
		}
		
		return $this->result;
	}

	/**
	 * Return generic variable
	 * 
	 * @param String $name: name of var to return
	 * @return Object $this Suport for method chaining
	 */
	public function loadDictionary($replace = false) {
		if($this->dictionary === null || $replace){
			$prefix = $this->prefix;
			$url = $this->baseurl;
			include_once 'dictionary.php';
			$this->dictionary = $cd;
		}
		return $this;
	}
	
	/**
	 * Set one generic variable the desired value
	 * 
	 * @param String $name: name of var to set value
	 * @param Mixed $value: value to set to desired variable
	 * @return Object $this Suport for method chaining
	 */
	public function set($name, $value) {
		$this->$name = $value;
		return $this;
	}
	
	/**
	 * Set browser engine name
	 * 
	 * @param String $name: name of browser
	 * @return Object $this Suport for method chaining
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	
	/**
	 * Set browser engine name
	 * 
	 * @param String $name: name of browser
	 * @return Object $this Suport for method chaining
	 */
	public function setBrowser($name) {
		$name = strtolower($name);
		if(!array_search($name, $this->browser)){
			$this->browser[] = $name;
		}
		return $this;
	}

}