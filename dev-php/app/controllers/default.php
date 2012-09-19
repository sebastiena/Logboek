<?php

function index() {

  return html('index.html.php');
}

function pages() {
  return html(params('page') . '.html.php');
}

function index_catchall() {

  return html('index.html.php');
}

function getTodaySheet(){
	$bestandNaam = date("d-m-Y");
	$myFile = "assets/locales/" . $bestandNaam . ".md";
		
	$fh = fopen($myFile, 'r');
	$theData = fread($fh, filesize($myFile));
	fclose($fh);
       

	return $theData;
}

function createfile(){
	
	$title = $_POST['datum'];
	$inhoud = $_POST['beschrijving'];
	
	$bestand = "assets/locales/" . $title . ".md";

	$fh = fopen($bestand, 'w') or die("can't open file");

	fwrite($fh, $inhoud);

	fclose($fh);

 	return html('index.html.php');
}

function openfile(){

	$bestandNaam = $_POST['bestandNaam'];
	$myFile = "assets/locales/" . $bestandNaam . ".md";
	
	$fh = fopen($myFile, 'r');
	$theData = fread($fh, filesize($myFile));
	fclose($fh);

	$my_html =  Markdown($theData);

	set('contentFile', $my_html);
	set('selectedDate', $bestandNaam);
	set('todayContent', $my_html);

	//return $theData;
	return html('index.html.php');

}

function printDays(){
		setlocale (LC_ALL, 'nl_NL');
					putenv( "PHP_TZ=Europe/Amterdam" );
					if ($handle = opendir('assets/locales')) {
					    while (false !== ($entry = readdir($handle))) {
					        if (strpos($entry , '.md', 1)) {
					        	$entry = preg_replace('/\.[^.]+$/','',$entry);
					        	echo '<form method="post" action="detail">';
					        	echo '<input type=hidden name="bestandNaam" value = "' . $entry .'" />';
					           	echo '<input type="submit" class="datebtn" value="' . $entry .'"/></br>'; 
					           	echo '</form>';
					        }
					    }
					    closedir($handle);
					}
}