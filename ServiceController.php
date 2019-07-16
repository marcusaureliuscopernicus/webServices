<?php
require_once("Clients.php");
require_once("Links.php");
require_once("Sections.php");


/*
controls services URL mapping
*/

$class = "";
if(isset($_GET["class"]))
    $class = $_GET["class"];

$action = "";
if(isset($_GET["action"]))
    $action = $_GET["action"];

switch($action){

    case "create":
        $class = new ucfirst($class);
        $class->create();
        break;

    case "update":
        $class = new ucfirst($class);
        $class->update($_GET["id"]);
        break;

    case "delete" :
        $class = new ucfirst($class);
        $class->delete($_GET["id"]);
        break;
}
?>
