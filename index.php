<?php
header('Content-Type: applications/json');
require "models/db.class.php";
require "controllers/controller.php";
require "controllers/errorescontroller.php";

$url = $_GET["action"] ?? null;

if ($url==null) {
  new ErroresController("La url no es valida");
}

$url = rtrim($url,'/');
$url = explode("/", $url);

if (count($url)<2) {
  new ErroresController("La url no es valida");
}

$archivoController = "controllers/{$url[0]}controller.php";

if (file_exists($archivoController)) {
  require $archivoController;
  $url[0] .= "Controller";
  $controller = new $url[0]($url[1],$url[2] ?? "");
} else {
  new ErroresController("La url no existe");
}