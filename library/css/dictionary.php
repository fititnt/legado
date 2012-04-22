<?php

/**
 * @package     Legado
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     License: Massachusetts Institute of Technology. See license.txt
 */
defined('LEGADO_BASE') or die('Direct access denied');

//@todo Yes, I know, must be improved (fititnt, 2012-04-22 14:58)

$cd = array();

$cd['gecko']['in'][] = '/(border-radius:)s*([^;]*)/i';
$cd['gecko']['out'][] = "$1$2;\n\t-moz-$1$2";
$cd['webkit']['in'][] = '/' . $prefix . '(border-radius:)s*([^;]*)/i';
$cd['webkit']['out'][] = $prefix  . "$1$2;\n\t-webkit-$1$2";
$cd['trident']['in'][] = '/' . $prefix  . '(border-radius:)s*([^;]*)/i';
$cd['trident']['out'][] = $prefix . "$1 $2;\n\tbehavior:url(" . $url . "border-radius.htc);";