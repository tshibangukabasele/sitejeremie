<?php
try {
 	$bdd= new PDO('mysql:host=localhost; dbname=espace_membre; charset=UTF8;', 'root', '');

 } catch (Exception $e) {
 	die('NOUS SOMMES EN MAINTENANCE');
 } 
?>