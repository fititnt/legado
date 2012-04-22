<?php

require_once 'legado.php';

class CSSLegacy extends Legado{


	/**
	 * @var String
	 */
	protected $defaults = array();

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

	protected function defaults() {

		$this->setSerAgent();

		$propRegex = array();
		//border-radius: 4px;
		$propRegex['gecko']['in'][] = '/(border-radius:)s*([^;]*)/i';
		$propRegex['gecko']['out'][] = "$1$2;\n\t-moz-$1$2";
		$propRegex['webkit']['in'][] = '/' . $this->prefix . '(border-radius:)s*([^;]*)/i';
		$propRegex['webkit']['out'][] = $this->prefix . "$1$2;\n\t-webkit-$1$2";
		$propRegex['trident']['in'][] = '/' . $this->prefix . '(border-radius:)s*([^;]*)/i';
		$propRegex['trident']['out'][] = $this->prefix . "$1 $2;\n\tbehavior:url(" . $this->helperbaseurl . "border-radius.htc);";

		$this->defaults = $propRegex;
		return $this;
	}



	public function legacy() {
		$this->result = $this->original;

		if (!count($this->defaults)) {
			$this->defaults();
		}
		if ($this->targets !== false && !count($this->targets)) {
			$this->setSerAgent();
		}

		if (is_array($this->targets)) {
			foreach ($this->targets AS $browser => $versions) {
				$this->result = preg_replace($this->defaults[$browser]['in'], $this->defaults[$browser]['out'], $this->result);
			}
		}

		if ($this->verbose) {
			$verbose = '/* CSSLegacy verbose mode ';
			$verbose .= "\n\n\t\$_SERVER['HTTP_USER_AGENT']: \n" . $_SERVER['HTTP_USER_AGENT'];
			$verbose .= "\n\n\t\$this->targets: \n" . print_r($this->targets, true);
			$verbose .= "*/\n";
			$this->result = $verbose . $this->result;
		}

		return $this->result;
	}
}