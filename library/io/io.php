<?php

/**
 * @package     Legado
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     License: Massachusetts Institute of Technology. See license.txt
 */
defined('LEGADO_BASE') or die('Direct access denied');

class LegadoIO {

	/**
	 * Array to contain RAW content to output
	 * 
	 * @todo change to outputbuffer (fititnt, 2012-04-22 14:13)
	 *
	 * @var array 
	 */
	protected $content = array();

	/**
	 * Array to contain RAW header info
	 * 
	 * @var array
	 */
	protected $header = array();
	
	/**
	 *
	 * @var Array 
	 */
	protected $inputbuffer = array();

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
	 * Return content generated by this class or childen class
	 * 
	 * 
	 * @param array $option 
	 *                     $option['method']: Method of return. Can be 'string'
	 *                     or 'array'. Default is 'string'
	 * @return mixed $content Can return Array, String or FALSE if error
	 */
	public function getContent($option = array()) {
		if (!is_array($option)) {
			//@todo raize error
			return FALSE;
		}
		if (!isset($option['method'])) {
			$option['method'] = 'string';
		}

		switch ($option['method']) {
			case 'string':
				if (count($this->content) > 0) {
					$content = implode(PHP_EOL, $this->content);
				} else {
					$content = FALSE;
				}
				break;
			case 'array':
				if (count($this->content) > 0) {
					$content = $this->content;
				} else {
					$content = FALSE;
				}
			default:
				//@todo raize error
				return FALSE;
		}

		return $content;
	}

	/**
	 * Retun one array with filenames from one folder
	 * 
	 * @todo make one extension filder
	 * @todo think if this class really is best place for this method
	 *
	 * @param type $path 
	 * @return array $filenames
	 */
	public function getDirectoryFilenames($path) {
		$filenames = array();
		$remove = array(
			'.',
			'..',
			'index.html'
		);
		$dir = opendir($path);
		while ($finename = readdir($dir)) {
			$filenames[] = $finename;
		}
		foreach ($filenames AS $k => $v) {
			if (in_array($v, $remove)) {
				unset($filenames[$k]);
			}
		}
		return $filenames;
	}

	/**
	 * Return file contents from disk
	 * 
	 * @param string $path
	 * @return string 
	 */
	public function getFile($path) {
		$filecontent = file_get_contents($path);
		return $filecontent;
	}

	/**
	 * Get seted header
	 *
	 * @param boolean $setnow
	 * @return mixed Return Array of headers if $setnow is set to TRUE, else 
	 *               will return void
	 */
	public function getHeader($setnow = FALSE) {
		if ($setnow === FALSE) {
			return $this->headers;
		} else {
			if (count($this->headers) > 0) {
				foreach ($this->headers AS $value) {
					header($value);
				}
			}
		}
	}
	
	/**
	 *
	 * @param Mixed $paths String or Array of files to load
	 * @param String $base Optimal base of files to load
	 * @return Object $this Suport for method chaining
	 */
	public function loadFile($paths, $base = '') {
		if (is_array($paths)) {
			foreach ($paths AS $path) {
				$this->inputbuffer[] = file_get_contents($base . $path) . PHP_EOL;
			}
		} else {
			$this->inputbuffer[] = file_get_contents($base . $path);
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
	 * Set new item to content array
	 */
	public function setContent($value) {
		$this->content[] = $value;
		return $this;
	}

	/**
	 *
	 * @param string $content Content to outup on file 
	 * @param string $name Name of file
	 * @param string $path Where save file
	 * 
	 */
	public function setFile($content, $name, $path = NULL) {
		//...
	}

	/**
	 * 
	 * @param mixed $values Array or String
	 * @return Object $this Suport for method chaining
	 */
	public function setHeader($values) {
		if (is_array($values) && count($values) > 0) {
			$this->headers = array_merge($this->headers, $values);
		} else {
			$this->headers[] = $values;
		}
	}

	/**
	 * Set cache control.
	 * 
	 * @example
	 * @code
	 * $phpjs = new PHPtoJavascript;
	 * $phpjs->setHeaderMimeType('js');
	 * $phpjs->getHeader(true);
	 * //Response Headers:
	 * //Cache-Control	no-cache, must-revalidate
	 * //Connection	Keep-Alive
	 * //Date	Wed, 29 Feb 2012 04:56:37 GMT
	 * //Expires	Sun, 25 Jan 1986 05:00:00 GMT
	 * @endcode
	 * 
	 * @see getHeader()
	 * @see setHeader()
	 * 
	 * @param mixed $time String for time expire, FALSE for no-cache
	 * 
	 * @todo make it calculate real time for expires, and try a bit better this
	 *       function on real examples. Also chance behavior to cache by default
	 *       by at least one day or week (fititnt, 2012-02-29 02:54)
	 * 
	 * @return Object $this Suport for method chaining
	 */
	public function setHeaderCache($time = FALSE) {
		if ($time === FALSE) {
			$this->headers[] = 'Cache-Control: no-cache, must-revalidate';
			$this->headers[] = 'Expires: Sun, 25 Jan 1986 05:00:00 GMT';
		} else {
			$this->headers[] = 'Expires: ' . $time;
		}
		return $this;
	}

	/**
	 * Set MimeType to be used. Try find the file extension and, if do not find
	 * just set you type
	 * 
	 * @example
	 * @code
	 * $phpjs = new PHPtoJavascript;
	 * $phpjs->setHeaderMimeType('js');
	 * $phpjs->getHeader(true);
	 * //Response Headers:
	 * //Content-Type	application/javascript
	 * @endcode
	 * 
	 * @see getHeader()
	 * @see setHeader()
	 * 
	 * @return Object $this Suport for method chaining
	 */
	public function setHeaderMimeType($type) {

		//Thanks svogal http://www.php.net/manual/en/function.mime-content-type.php#87856
		$mime_types = array(
			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',
			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',
			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',
			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',
			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',
			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',
			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet'
		);

		if (isset($mime_types[$type])) {
			$this->headers[] = 'Content-type: ' . $mime_types[$type];
		} else {
			$this->headers[] = 'Content-type: ' . $type;
		}
		return $this;
	}

}