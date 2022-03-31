<?php
include 'connectionBD.php';
if (isset($_GET['sup'])) {
	$suppression= $_GET['sup'];

	$req_sup= $bdd->prepare("DELETE FROM client WHERE id_cli=?");
	$req_sup->execute(array($suppression));
	header('Location:formulaire2.php');	
}
?>