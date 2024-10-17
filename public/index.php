<?php

require_once "../src/LinkController.php";

$linkController = new LinkController();
?>

<form action="./routing.php" type="post" onsubmit="$linkController->createLink()">
    <input type="submit" value="Submit">
</form>