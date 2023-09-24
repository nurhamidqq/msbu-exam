<?php
require "bootstrap.php";
use Src\Controller\ProductController;

header("Content-Type: application/json; charset=UTF-8");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
if ($uri[1] !== 'product') {
    header("HTTP/1.1 404 Not Found");
    exit();
}
$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new ProductController($dbConnection, $requestMethod);
$controller->processRequest();

?>