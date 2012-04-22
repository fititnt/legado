<?php

/**
 * @package     JTemplateHelper
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright    
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or define('_JEXEC', 1); //Set _JEXEC for be able to access helper
require_once 'templatehelper.php';
$jth  = new JTemplateHelper();
echo $jth->JS();

