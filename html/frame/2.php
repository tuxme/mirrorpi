 <head>
    <meta http-equiv="refresh" content="60"> <!-- See the difference? -->
  </head>
    <style type="text/css">
@font-face { font-family: Delicious; src: url('../font.otf'); } @font-face { font-family: Delicious; font-weight: bold; src: url('../font.otf'); }
body {
  font-family: 'Delicious', serif;
  font-size: 48px;
}
</style> </head>

<div align='center'>
<p>
<font color="white">
<?php
try
	{
	include('configfile.conf') ;
	$bdd = new PDO("mysql:host=localhost;dbname=$DBNAME;charset=utf8", "$DBUSER", "$DBPASS");
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


$reponse = $bdd->query("SELECT id,what,description FROM todolist where completed=0 and visible=1 ORDER BY RAND() limit 1 ");

while ($donnees = $reponse->fetch())
{
	print "*($donnees[id]) $donnees[what]";
	print "<br><font size='3'><i>($donnees[description])</i></font>";
}
?>
</font>
</p>

</div>

