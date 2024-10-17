<?php
require_once "../src/LinkController.php";

$linkController = new LinkController();

$token = $linkController->createLink();
$usages = $linkController->numberOfUsages();
switch ($usages) {
    
    case '0':
        require __DIR__ . $viewDir . 'ok.php';
        break;

    case '2':
        require __DIR__ . $viewDir . 'mal.php';
        break;
    case '3':
        require __DIR__ . $viewDir . 'mal.php';
        break;
    case '4':
        require __DIR__ . $viewDir . 'mal.php';
        break;
    default:
        require __DIR__ . $viewDir . 'acoso.php';
}

?>