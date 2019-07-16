<?php
require_once("Client.php");
require_once("Link.php");
require_once("Section.php");


/*
controls services URL mapping
*/

$type = "";
if(isset($_POST["type"]))
    $class = $_POST["type"];

$action = "";
if(isset($_GET["action"]))
    $action = $_GET["action"];

switch($action){

    case "create":
        $class = new ucfirst($type);
        $class->create();
        break;

    case "update":
        $class = new ucfirst($type);
        $class->update($_POST["id"]);
        break;

    case "delete" :
        $class = new ucfirst($type);
        $class->delete($_POST["id"]);
        break;
}
?>
