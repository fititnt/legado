<?php

require_once '../../library/loader.php';

$io = Legado::getIO();

print_r($io->debug(array('method' => 'console')));


echo '<pre>';
echo "getDirectoryFilenames: \n";
$filenames = $io->getDirectoryFilenames(LEGADO_BASE . '/../tests/sample-input');
print_r($filenames);

echo "\n\nPrint filenames (getDirectoryFilenames(), loadFile(), get(): \n";

$inputbuffer = $io->loadFile($filenames, LEGADO_BASE . '/../tests/sample-input/')->get('inputbuffer');
echo implode(PHP_EOL, $inputbuffer);
