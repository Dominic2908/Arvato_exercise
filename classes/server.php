<?php

// Benoetigter AjaxController wird eingebunden
require_once 'Controller.php';

// Neue Instanz des Controllers anlegen
$Controller = new Controller();

// Controller ausgefuehren
echo $Controller->execute();