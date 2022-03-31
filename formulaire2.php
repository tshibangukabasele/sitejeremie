<link rel="stylesheet" type="text/css" href="position.css">
<?php
include 'connectionBD.php';
if (isset($_POST['envoyer'])) {
	if (isset($_POST['nom_article']) and isset($_FILES['photo_article'])) {
		if (!empty($_POST['nom_article']) and !empty($_FILES['photo_article'])) {
			$nom_article=$_POST['nom_article'];

			$photo=$_FILES['photo_article']['name'];
        	$file_extension=strrchr($photo, ".");
        	$file_tmp_name=$_FILES['photo_article']['tmp_name'];
        	$finalcateg='Image_'.$nom_article.''.$file_extension;
        	$file_dest='./media/videos/'.$finalcateg;
        	$extensions_autorisees=array('.mp4','.MP4','.mp3','.MP3');

		if (in_array($file_extension, $extensions_autorisees)) {
            		if(move_uploaded_file($file_tmp_name,$file_dest)) { 
			$inserer_article= $bdd->prepare('INSERT INTO client(nom, video) VALUES(?, ?)');
			$inserer_article->execute(array($nom_article, $finalcateg));
			echo "inscription reussie";
				}else{
					echo "1";
				}
			}else{
				echo "2";
			}
		}else{
			echo "3";
		}
	}else{
		echo "4";
	}
}
?>
<?php 
include 'connectionBD.php';
$bd_video= $bdd->query('SELECT * FROM client limit 0');
if (isset($_POST['soumettre'])) {
	if (isset($_POST['recherche'])) {
		$recherche=$_POST['recherche'];
		$bd_video= $bdd->query('SELECT * FROM client  WHERE nom LIKE "%'.$recherche.'%" ');
	}
}
?>
<form method="POST" enctype="multipart/form-data">
	<input type="text" name="nom_article" placeholder="nom de l'article"><br><br>
	<input type="file" name="photo_article"><br><br>
	<button name="envoyer">INSERER ARTICLE</button>
</form>
<?php
$selection= $bdd->query('SELECT * FROM client');
while ($donn=$selection->fetch()) {?>
	<p><?= $donn['nom'] ?><a href="deletes.php?sup=<?=$donn['id_cli']?>">Supprimer</a></p>
	<p><video  controls src="./media/videos/<?= $donn['video'] ?>" width="300"></video> 	
</p>
 <?php }
 $deuxieme=$bdd->query('SELECT * FROM client');
 $affiche=$deuxieme->rowCount();
 echo $affiche; 
?>
<form method="POST">
	<input type="search" name="recherche" class="bouge">
	<input type="submit" name="soumettre" class="bouge">
</form>
<?php
if ($bd_video->rowCount()>0) {
 	while ($affiche=$bd_video->fetch()) {?>
  	<p style="border: solid 1px red; width: 22.7%;"><video  controls src="./media/videos/<?=$affiche['video'] ?>" width="300"></p>
  <?php }
 } 
?>