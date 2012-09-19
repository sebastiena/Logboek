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

function getTodaySheet($date){
	$bestandNaam = $date;
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

function getNext($datumGegeven){

	$arrayBestanden = array();

	if ($handle = opendir('assets/locales')) {
		while (false !== ($entry = readdir($handle))) {
				if (strpos($entry , '.md', 1)) {
					$entry = preg_replace('/\.[^.]+$/','',$entry);
					array_push($arrayBestanden, $entry);

				}
		}
		closedir($handle);
	}
	$momenteel = 0;
	for ($i = 0; $i < count($arrayBestanden); $i++) {
	    if ($arrayBestanden[$i] == $datumGegeven){
	    	$momenteel = $i;
	    }
	}
	if(($momenteel+1) == count($arrayBestanden)){
		$momenteel = 0;
	}else{
		$momenteel++;
	}
	return $arrayBestanden[$momenteel];

}

function getPrev($datumGegeven){

	$arrayBestanden = array();

	if ($handle = opendir('assets/locales')) {
		while (false !== ($entry = readdir($handle))) {
				if (strpos($entry , '.md', 1)) {
					$entry = preg_replace('/\.[^.]+$/','',$entry);
					array_push($arrayBestanden, $entry);

				}
		}
		closedir($handle);
	}
	$posmomenteel = 0;

	for ($i = 0; $i < count($arrayBestanden); $i++) {
	    if ($arrayBestanden[$i] == $datumGegeven){
	    	$posmomenteel = $i;
	    }
	}
	if(($posmomenteel) == 0){
		$posmomenteel = (count($arrayBestanden)-1);
	}else{
		$posmomenteel--;
	}
	return $arrayBestanden[$posmomenteel];

}

function printDays($selectedDate){

	setlocale (LC_ALL, 'nl_NL');
	putenv( "PHP_TZ=Europe/Amterdam" );
	if (!(isset($selectedDate))){
		$selectedDate = date("d-m-Y");
	}
	
		if ($handle = opendir('assets/locales')) {
			while (false !== ($entry = readdir($handle))) {
				if (strpos($entry , '.md', 1)) {
					    $entry = preg_replace('/\.[^.]+$/','',$entry);
					    echo '<form method="post" action="detail">';
					    echo '<input type=hidden name="bestandNaam" value = "' . $entry .'" />';
						    if ($entry == $selectedDate){
						    	echo '<input type="submit" class="datebtnSelected" value="' . $entry .'"/></br>';
						    }else{
						    	echo '<input type="submit" class="datebtn" value="' . $entry .'"/></br>';
							}
					    echo '</form>';
				}
			}
			closedir($handle);
		}
	
}