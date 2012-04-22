<?php

/**
 * @package     Legado
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     License: Massachusetts Institute of Technology. See license.txt
 */
defined('LEGADO_BASE') or die('Direct access denied');

class LoadCSS {

    /**
     *
     * @return instance LegadoCSS 
     */
    public static function getInstance() {
        require_once 'css.php';
        $instance = new LegadoCSS();
        return $instance;
    }
}