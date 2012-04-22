<?php

require_once 'legado.php';

class Legado {
	

	/**
	 * @var String
	 */
	protected $original = '';
	
	/**
	 * @var String
	 */
	protected $targets = array();
	
	/**
	 * Value that must have before the propetie to allow
	 * 
	 * @var String 
	 */
	protected $helperbaseurl = "";
	
	public function loadFile($paths) {
		if (is_array($paths)) {
			foreach ($paths AS $path) {
				$this->original .= file_get_contents($path) . PHP_EOL;
			}
		} else {
			$this->original .= file_get_contents($paths);
		}
		return $this;
	}

	public function loadString($content) {
		if (is_array($content)) {
			$content = implode(PHP_EOL, $content);
		}
		$this->original .= $content;
		return $this;
	}
	public function setHelperBaseURL($url = ''){
		$this->helperbaseurl = $url;
		return $this;
	}
	
	public function setSerAgent($targets = null) {

		if ($targets === false) {
			$this->targets = false; //To do not parse based on agent
		} else {
			if ($targets !== null) {
				$ua = ' ' . $targets;
			} else {
				$ua = ' ' . strtolower($_SERVER['HTTP_USER_AGENT']);
			}

			if (strpos($ua, 'webkit')) {
				$this->targets['webkit']['min'] = null;
				$this->targets['webkit']['max'] = null;
			} else if (strpos($ua, 'trident')) {
				$this->targets['trident']['min'] = null;
				$this->targets['trident']['max'] = null;
			} else if (strpos($ua, 'gecko')) {
				$this->targets['gecko']['min'] = null;
				$this->targets['gecko']['max'] = null;
			} else if (strpos($ua, 'presto')) {
				$this->targets['presto']['min'] = null;
				$this->targets['presto']['max'] = null;
			}
		}

		//or just set directly
		//$this->targets = $targets;

		return $this;
	}

	public function verbose($level = 1) {
		$this->verbose = $level;
		return $this;
	}
}