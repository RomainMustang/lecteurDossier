<?php

/*  Si on a cliquer sur un lien ou pas  */
if(!isset($_GET['path']))
{
	$repertoire = "c:/wamp64/www/";
	$path="";
}

else
{
	$repertoire = "c:/wamp64/www". $_GET['path'];
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
			<a class="liensHaut" href="?">ACCUEIL</a>
			<?php
				$parent = directorieParent($path);
				echo "<a class='liensHaut' href='?path=$parent'>Dossier parent</a>";
			?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-offset-2 col-md-8">

	<?php

	/*  Vérifie si on est dans un dossier  */
	if(is_dir($repertoire))
	{
		$dossiers = [];
		$fichiers = [];

		$elements = scandir($repertoire);

		foreach ($elements as $element) 
		{
			if(is_dir($repertoire."/".$element))
			{
				if($element != ".." && $element != ".")
				{
					$dossiers[] = $element;
				}
			}
			else
			{
				if($element != ".htaccess")
				{
					$fichiers[] = $element;
				}
			}
		}

		for($i = 0 ; $i < count($dossiers); $i++)
		{
			$tableau = verifFile($dossiers[$i]);
			$chemin =$dossiers[$i];
			echo "<div class='col-md-2'>
						<a class='aligne' href='?path=$path/$chemin'><img src='css/images/dossier.png'>$dossiers[$i]</a>
				  </div>";
		}

		for($i = 0 ; $i < count($fichiers); $i++)
		{
			$tableau = verifFile($fichiers[$i]);
			$extention = $tableau[1];
			$chemin =$fichiers[$i];
			echo "<div class='col-md-2'>
						<a class='aligne' href='?path=$path/$chemin'><img src='css/images/$extention.png'>$fichiers[$i]</a>
				  </div>";	
		}
	}
	else
	{
		showFile($repertoire, $path);
	}

	function showFile($file, $path)
	{
		$doc = verifFile($file);
		if($doc[1] == "png" || $doc[1] == "ico"  || $doc[1] == "jpg")
		{
			echo "<img src='$path'>";
		}
		else
		{
			echo "<a href='$path'>télécharger</a> <br>";
			echo htmlentities(highlight_string(file_get_contents($file)));
		}		
	}

	/*  Recherche du dossier parent  */
	function directorieParent($chemin)
	{
		$position = strripos($chemin, "/");

		return substr($chemin, 0, $position - strlen($chemin));
	}

	/*  Cherche le format du document  */
	function verifFile($doc)
	{
		$tableau = [];
		$tableau[0] = strripos($doc, ".");
		$tableau[1] = substr($doc, $tableau[0] + 1);
		return $tableau;
	}

	?>
		</div>
	</div>

</body>

</html>