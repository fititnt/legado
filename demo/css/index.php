<?php

require_once '../../library/loader.php';

$io = Legado::getIO();
$css = Legado::getCSS();


echo '<pre>';

$filenames = $io->getDirectoryFilenames(LEGADO_BASE . '/../tests/sample-input');
$inputbuffer = $io->loadFile($filenames, LEGADO_BASE . '/../tests/sample-input/')->get('inputbuffer');
$original = implode(PHP_EOL, $inputbuffer);

echo "\n Before:\n";
echo $original;

echo "\n\n After, webkit:\n";
echo $css->setBrowser('webkit')->setBrowser('gecko')->setContent($original)->getContent();
