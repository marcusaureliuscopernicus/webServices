<?php
require_once("Client.php");
require_once("Link.php");
require_once("Section.php");


/*
controls services URL mapping
*/

$class = "";
if(isset($_POST["class"]))
    $class = $_POST["class"];

$action = "";
if(isset($_POST["action"]))
    $action = $_POST["action"];

switch($action){

    case "create":
        $class = new ucfirst($class);
        $class->create();
        break;

    case "update":
        $class = new ucfirst($class);
        $class->update($_POST["id"]);
        break;

    case "delete" :
        $class = new ucfirst($class);
        $class->delete($_POST["id"]);
        break;
}
?>
