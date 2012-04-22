<?php

/**
 * @package     {yourpackage}
 * @author      {yourname}
 * @copyright   {yourcopyright}
 * @license     {yourlicense}
 *
 */
defined('_JEXEC') or die;

//Load JTH base
require_once 'jth.php';

define('JDEV_DEBUG', 1); //1 DEBUG. Comment this line on production

/**
 * This is one example of class that extends JTH base class. Use this as
 * as a example and call this one, and not JTH directly.
 * @example
 * @code
 * //This code on your index.php template
 * require_once '/subfoldername/templatehelper.php';
 * $jth = new JTemplateHelper($this);
 * //print_r($jth);
 * @endcode
 */
final class JTemplateHelper extends JTH {

	function __construct($that = NULL) {
		parent::__construct($that);
		//...
	}

	/**
	 * Gera string contendo o CSS necessario para ser impresso em um
	 * arquivo especifico, e evitar javascript inline
	 * 
	 * @return string 
	 */
	public function CSS() {
		$cssFinal = '';
		$cssFiles = array();
		$cssFiles[] = '../css/base.css';
		$cssFiles[] = '../css/treinamento.css';
		//$cssFiles[] = '../css/ie.css';

		$legacy = $this->getHelper('csslegacy');
		$legacy->verbose();
		$legacy->setHelperBaseURL('http://201.37.69.243:5581/treinamento/templates/treinamento/helpers/');
		$legacy->setSerAgent(false);
		
		$legacy->loadFile($cssFiles);
		$cssFinal = $legacy->legacy();

		//@todo remover necessidade deste outro helper (fititnt, 2012-04-21 05:49)
		$h = $this->getHelper('phptostring');
		$h->setHeaderMimeType('css');
		$h->setHeaderCache(); //Se vazio, forca nao cachear
		$h->getHeader(true); //Prepara o header do arquivo
		
		echo $cssFinal;
	}

}