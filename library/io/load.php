<?php

/**
 * @package     Legado
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     License: Massachusetts Institute of Technology. See license.txt
 */
defined('LEGADO_BASE') or die('Direct access denied');

class LoadIO {

    /**
     *
     * @return instance LegadoIO 
     */
    public static function getInstance() {
        require_once 'io.php';
        $instance = new LegadoIO();
        return $instance;
    }
}