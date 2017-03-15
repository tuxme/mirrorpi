<?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
        <head>
<meta charset="utf-8" />
                <title>Todolist Family</title>
        </head>

<script src="reloader.js" type="text/javascript"></script>
<style type="text/css">
        @font-face { font-family: Delicious; color='white';src: url('font.otf'); } @font-face { font-family: Delicious; font-weight: bold; src: url('font.otf'); }
        body    {
                font-family: 'Delicious', serif;
                }

</style>
<body text="white" style="background-color:black" onload="reloadGraph()">


<div align="center">

<p>

    <img src="../img/change.gif" width="10%" height="10%">

<?php
	// Database Constants
	include('../frame/configfile.conf') ;
	define("DB_SERVER", "127.0.0.1");
	define("DB_USER", "$DBUSER");
	define("DB_PASS", "$DBPASS");
	define("DB_NAME", "$DBNAME");
	// 1. Create a database connection
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_set_charset("utf8");


	if ( !$connection ) {
		die("Database connection failed: " . mysql_error());
	}
	// 2. Select a database to use
	$db_select = mysql_select_db(DB_NAME, $connection);
	if ( !$db_select ) {
		die("Database selection failed: " . mysql_error());
	}
	function setTask( $task,$desc ) {
		global $connection;
		$query = "INSERT INTO todolist (what, description, completed, visible) VALUES (\"{$task}\",\"{$desc}\", 0, 1)";
		$result = mysql_query( $query, $connection );
		#echo mysql_error();
	}
	function confirm_query( $result_set ) {
		if ( !$result_set ) {
			die("Database query failed: " . mysql_error() );
		}
	}
	# Delete All Rows from table
	function deleteRows () {
		global $connection;
		$query = "DELETE FROM todolist";
		$result = mysql_query( $query, $connection );
		$query = "ALTER TABLE todolist AUTO_INCREMENT = 1";
		$result = mysql_query( $query, $connection );
	}
	# Set task completion flag to 1 using Task Number
	function completedTask ( $taskNum ) {
		global $connection;
		$query = "UPDATE todolist SET completed = 1 WHERE id={$taskNum}";
		$result = mysql_query($query, $connection);
		#if ( ) {
		#	echo "Change Success, " . mysql_affected_rows() . " rows affected.";
		#} else {
		#	echo mysql_error();
		#}
	}
	# Set task visibility to 0 using Task Number
	function hideTask( $taskNum ) {
		global $connection;
		$newText = "Something";
		$query = "UPDATE todolist SET visible=0 WHERE id={$taskNum}";
		$result = mysql_query($query, $connection);
	}
	# Displays All Visible Tasks
	function getAllTask() {

		global $connection;

		$query = "SELECT * FROM todolist WHERE visible=1";
		$result = mysql_query($query, $connection);
		
		while ( $list = mysql_fetch_array($result) ) {
			#echo print_r($list) . "<br/>";
			echo "<font size='5'>#" . $list[0] . ": " . $list[1] . "<br /></font><font size='3'>" . $list[2] . "</font><hr>";
		}
	}
	# Displays All Visible Tasks
	function getHiddenTask() {
		global $connection;
		$query = "SELECT * FROM todolist WHERE visible=0";
		$result = mysql_query($query, $connection);
		
		while ( $list = mysql_fetch_array($result) ) {
			echo "Task #" . $list[0] . ": " . $list[1] . "<br />";
		}
	}
	# Check for task
	if ( isset( $_POST['taskName'] ) && $_POST['taskName'] !== "" && isset($_POST['taskDesc'] ) && $_POST['taskDesc'] ) {		
		$taskName = $_POST['taskName'];
		$taskDesc = $_POST['taskDesc'];
		#echo $taskName;
		setTask( $taskName, $taskDesc);
	}
	# Check for hide task number
	if ( isset( $_POST['num'] ) ) {
		$taskNum = $_POST['num'];
		hideTask( $taskNum );
	}
	echo "<form name=\"input\" action=\"index.php\" method=\"post\" >";
	echo "Nom de votre tache : ";
	echo "<input type=\"text\" name=\"taskName\" >";
	echo "<br> Description de la tache : <br>";
#	echo "<input type=\"text\" name=\"taskDesc\" >";
	echo "<textarea cols=\"50\" rows=\"5\" name=\"taskDesc\"></textarea>";
	echo "<br/>";
	echo "<br/>";
	#echo "<label>Enter Task Number to Hide: ";
	echo "<input type=\"submit\" name=\"submit\" />";
	echo "<br/><br/>";
	echo "</form><img src='../img/line.png'>";
	echo "<br/><br/>";
#	echo "To-Do List: " . "<br/>";
	echo getAllTask();
	echo "<br/>";
	//echo "Hidden List: " . "<br/>";
	//echo getHiddenTask();


	echo "Entrez le numéro de la liste que vous voulez cacher : ";
        echo "<form name=\"input\" action=\"index.php\" method=\"post\" >";
        echo "<input type=\"text\" name=\"num\" placeholder=\"enter task number to hide here\"/>";
        echo "<br/><br/>";
        echo "<input type=\"submit\" name=\"submit\" />";

?>
