<?php

/**
 * @package     Legado
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     License: Massachusetts Institute of Technology. See license.txt
 */
defined('LEGADO_BASE') or die('Direct access denied');

abstract class Legado {
	
	/**
	 *
	 * @var Object $css
	 */
	public static $browser;

	/**
	 *
	 * @var Object $css
	 */
	public static $css;

	/**
	 *
	 * @var Object $io
	 */
	public static $io;

	/**
	 *
	 * @var Object $js
	 */
	public static $js;
	
	/**
	 * Return Browser Object, creating if aready doesent exists
	 *
	 * @return Object $generic
	 */
	public static function getBrowser() {
		if (!self::$browser) {
			require_once '/browser/load.php';

			self::$browser = LoadBrowser::getInstance();
		}
		return self::$browser;
	}

	/**
	 * Return CSS Object, creating if aready doesent exists
	 *
	 * @return Object $generic
	 */
	public static function getCSS() {
		if (!self::$css) {
			require_once '/css/load.php';

			self::$css = LoadCSS::getInstance();
		}
		return self::$css;
	}

	/**
	 * Return IO Object, creating if aready doesent exists
	 *
	 * @return Object $generic
	 */
	public static function getIO() {
		if (!self::$io) {
			require_once '/io/load.php';

			self::$io = LoadIO::getInstance();
		}
		return self::$io;
	}

	/**
	 * Return JS Object, creating if aready doesent exists
	 *
	 * @return Object $generic
	 */
	public static function getJS() {
		if (!self::$js) {
			require_once '/js/load.php';

			self::$js = LoadJS::getInstance();
		}
		return self::$js;
	}

}