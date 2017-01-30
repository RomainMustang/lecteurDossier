<?php

/*  Si on a cliquer sur un lien ou pas  */
if(!isset($_GET['path']))
{
	$repertoire = "c:/wamp64/www/";
	$path="";
}

else
{
	$repertoire = "c:/wamp64/www/". $_GET['path'];
	$path = $_GET['path'];
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Lecteur de fichiers</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="col-md-12">
		<div class="col-md-offset-5">
			<a class="liensHaut" href="?">ACCEUIL</a>
			<?php
				$parent = reportorieParent($path);
				echo "<a class='liensHaut' href='?path=$parent'>Dossier parent</a>";
			?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-offset-2 col-md-8">

	<?php

	/*  Si on a cliquer sur un lien ou pas  */
	if(!isset($_GET['path']))
	{
		$repertoire = "c:/wamp64/www/";
		$path="";
	}

	else
	{
		$repertoire = "c:/wamp64/www/". $_GET['path'];
		$path = $_GET['path'];
	}


	/*  Vérifie si on est dans un dossier  */
	if(is_dir($repertoire))
	{
		$dossier = scandir($repertoire);

		for($i = 2 ; $i < count($dossier); $i++)
		{
			$tableau = verifFile($dossier[$i]);

			/*  Le document est un dossier  */
			if($tableau[0] == NULL)
			{
				$chemin =$dossier[$i];
				echo "<a class='aligne' href='?path=$path/$chemin'>$dossier[$i]<img src='css/images/dossier.png'></a>";
			}

			/*  Le document est un fichier  */
			else
			{
				$chemin =$dossier[$i];
				$extention = $tableau[1];
				echo "<a class='aligne' href='?path=$path/$chemin'>$dossier[$i]<img src='css/images/$extention.png'></a>";
			}
		}
	}


	/*  Recherche du dossier parent  */
	function reportorieParent($chemin)
	{
		$position = strripos($chemin, "/");

		return substr($chemin, 0, $position - strlen($chemin));
	}

	/*  Cherche le format du document  */
	function verifFile($file)
	{
		$tableau = [];
		$tableau[0] = strripos($file, ".");
		$tableau[1] = substr($file, $tableau[0] + 1);
		return $tableau;
	}

	?>
		</div>
	</div>

</body>

</html>