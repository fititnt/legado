<?php

require_once '../../library/loader.php';

$io = Legado::getIO();

print_r($io->debug(array('method' => 'console')));


echo '<pre>';
echo "getDirectoryFilenames: \n";
$filenames = $io->getDirectoryFilenames(LEGADO_BASE . '/../tests/sample-input');
print_r($filenames);
