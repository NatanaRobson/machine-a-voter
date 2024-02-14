<?php

use DbConnect as GlobalDbConnect;
use Mdevoldere\PhpLibrary\Db\DbConnect as DbDbConnect;
use Nrobson\MachineAVoter\DbConnect;
use Nrobson\MachineAVoter\DbConnect\DbConnect as DbConnectDbConnect;
use Nrobson\MachineAVoter\src\Db\DbConnect as SrcDbDbConnect;

// use Nrobson\MachineAVoter\DbConnect\DbConnect as DbConnectDbConnect;

require '../../vendor/autoload.php';

echo 'DOSSIER TEST CONFIG! <hr>';
echo '<hr>';
$config = require './config.php';
$c1 = $config[0];
$c2 = $config[1];
$c3 = ['oui', 'non', 'autre'];

var_export($config[0]);
echo '<hr>';
var_export($config[1]);
echo '<hr>';

if (!in_array($c1, $config)) {
    echo 'Le tableau que vous cherchez n\'est pas dans le tableau source...';
} else {
    echo 'Tableau trouvé !!!';
}

echo '<hr>';
echo '<hr>';

$path = '../config.php';
if (is_file($path)) {
    echo 'Le chemin indiqué coresspond à un fichier !!! <br> ==> <br>';
    $file_return = require $path;
    var_export($file_return);;
} else {
    throw new Exception('Le chemin indiqué ne coresspond pas à un fichier...');
    echo 'Le chemin indiqué ne coresspond pas à un fichier...';
}

// $pdo = GlobalDbConnect::getInstance();
// var_export($pdo);

$pdo = SrcDbDbConnect::getInstance();
var_export($pdo);
