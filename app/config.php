<?php 
define("server_name", "localhost");
define("db_name", "memegenerator");
define("user", "root");
define("password", "");

try{
    $connexion = new PDO('mysql:host='.constant("server_name").';charset=UTF8;dbname='.constant("db_name"), constant("user"), constant("password"));
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Error :".$e->getMessage());
}