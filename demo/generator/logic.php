<?php

require_once '../../library/loader.php';

$browser = Legado::getBrowser();
$css = Legado::getCSS();
$io = Legado::getIO();
$js = Legado::getJS();

print_r($browser->debug(array('method' => 'console')));
print_r($css->debug(array('method' => 'console')));
print_r($io->debug(array('method' => 'console')));
print_r($js->debug(array('method' => 'console')));