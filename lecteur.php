<?php

$dir = 'C:/wamp64/www';
$files = scandir($dir);


for($i = 0 ; $i < count($files); $i++)
{
	echo $files[$i] . "<br>";
}

?>